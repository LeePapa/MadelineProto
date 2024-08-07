#!/usr/bin/env php
<?php
/*
Copyright 2016-2020 Daniil Gentili
(https://daniil.it)
This file is part of MadelineProto.
MadelineProto is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
MadelineProto is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU Affero General Public License for more details.
You should have received a copy of the GNU General Public License along with MadelineProto.
If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Various ways to load MadelineProto.
 */

use Amp\ByteStream\ReadableBuffer;
use danog\MadelineProto\API;
use danog\MadelineProto\FileCallback;
use danog\MadelineProto\Logger;
use danog\MadelineProto\Settings\AppInfo;
use danog\MadelineProto\VoIP;
use Webmozart\Assert\Assert;

use function Amp\File\read;

$loader = false;
if (getenv('ACTIONS_PHAR')) {
    $loader = include 'madeline.php';
} elseif (!file_exists(__DIR__.'/../vendor/autoload.php') || getenv('ACTIONS_FORCE_PREVIOUS')) {
    echo 'You did not run composer update, using madeline.php'.PHP_EOL;
    if (!file_exists('madeline.php')) {
        copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
    }
    include 'madeline.php';
} else {
    require_once 'vendor/autoload.php';
}
define('MADELINEPROTO_TEST', 'testing');
if ($loader) {
    foreach ($loader->getClassMap() as $class => $file) {
        if (in_array($class, [
            'Amp\\Sync\\Internal\\MutexStorage',
            'Amp\\Sync\\Internal\\SemaphoreStorage',
            'Amp\\Parallel\\Sync\\Internal\\ParcelStorage',
            'Amp\\Parallel\\Context\\Internal\\Thread',
            'Monolog\\Test\\TestCase',
            'Phabel\\Amp\\Sync\\Internal\\MutexStorage',
            'Phabel\\Amp\\Sync\\Internal\\SemaphoreStorage',
            'Phabel\\Amp\\Parallel\\Sync\\Internal\\ParcelStorage',
            'Phabel\\Amp\\Parallel\\Context\\Internal\\Thread',
            'Phabel\\Monolog\\Test\\TestCase',
            'Phabel\\Symfony\\Component\\DependencyInjection\\Compiler\\CompilerPassInterface',
            'Phabel\\Symfony\\Component\\String\\Slugger\\AsciiSlugger',
            'Phabel\\Composer\\Plugin',
            'PhabelVendor\\Amp\\Sync\\Internal\\MutexStorage',
            'PhabelVendor\\Amp\\Sync\\Internal\\SemaphoreStorage',
            'PhabelVendor\\Amp\\Parallel\\Sync\\Internal\\ParcelStorage',
            'PhabelVendor\\Amp\\Parallel\\Context\\Internal\\Thread',
            'PhabelVendor\\Monolog\\Test\\TestCase',
            'PhabelVendor\\Symfony\\Component\\DependencyInjection\\Compiler\\CompilerPassInterface',
            'PhabelVendor\\Symfony\\Component\\String\\Slugger\\AsciiSlugger',
        ], true)) {
            continue;
        }
        if (str_starts_with($class, 'Symfony\\Thanks')) {
            continue;
        }
        if (str_starts_with($class, 'PhabelVendor\\Symfony\\Component\\Console') || str_starts_with($class, 'Phabel\\Symfony\\Component\\Console') || str_ends_with($class, 'Test') || class_exists($class) || interface_exists($class)) {
            continue;
        }
        require_once($file);
    }
}

echo 'Loading settings...'.PHP_EOL;
$settings = (new AppInfo)
    ->setApiId((int) getenv('API_ID'))
    ->setApiHash(getenv('API_HASH'));

/*
 * Load MadelineProto
 */
echo 'Loading MadelineProto...'.PHP_EOL;
$MadelineProto = new API(__DIR__.'/../testing.madeline', $settings);

$MadelineProto->start();
$MadelineProto->fileGetContents('https://google.com');

/*
 * Test logging
 */
$MadelineProto->logger('hey', Logger::ULTRA_VERBOSE);
$MadelineProto->logger('hey', Logger::VERBOSE);
$MadelineProto->logger('hey', Logger::NOTICE);
$MadelineProto->logger('hey', Logger::WARNING);
$MadelineProto->logger('hey', Logger::ERROR);
$MadelineProto->logger('hey', Logger::FATAL_ERROR);

/**
 * A small example message to use for tests.
 */
$message = getenv('GITHUB_SHA') == '' ?
    'I iz works always (io laborare sembre) (yo lavorar siempre) (mi labori ĉiam) (я всегда работать) (Ik werkuh altijd) (Ngimbonga ngaso sonke isikhathi ukusebenza)' :
    ('Github actions tests in progress: commit '.getenv('GITHUB_SHA').', job '.getenv('GITHUB_JOB').', PHP version: '.PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION);

/*
 * Try making a phone call
 */
if (!getenv('GITHUB_SHA') && stripos(($MadelineProto->readline('Do you want to make a call? (y/n): ')) ?? '', 'y') !== false) {
    $controller = $MadelineProto->requestCall(getenv('TEST_SECRET_CHAT'))->play('input.raw')->then('input.raw')->playOnHold(['input.raw'])->setOutputFile('output.raw');
    while ($controller->getCallState() < VoIP::CALL_STATE_READY) {
        $MadelineProto->sleep(1);
    }
    $MadelineProto->logger($controller->configuration);
    while ($controller->getCallState() < VoIP::CALL_STATE_ENDED) {
        $MadelineProto->sleep(1);
    }
}

/*
 * Try receiving a phone call
 */
if (!getenv('GITHUB_SHA') && stripos(($MadelineProto->readline('Do you want to handle incoming calls? (y/n): ')) ?? '', 'y') !== false) {
    $howmany = $MadelineProto->readline('How many calls would you like me to handle? ');
}

/*
 * Secret chat usage
 */
if (!getenv('GITHUB_SHA') && stripos(($MadelineProto->readline('Do you want to make the secret chat tests? (y/n): ')) ?? '', 'y') !== false) {
    if (!getenv('TEST_SECRET_CHAT')) {
        throw new Exception('No TEST_SECRET_CHAT environment variable was provided!');
    }
    /**
     * Request a secret chat.
     */
    $secret_chat_id = $MadelineProto->requestSecretChat(getenv('TEST_SECRET_CHAT'));
    echo 'Waiting 10 seconds for '.getenv('TEST_SECRET_CHAT').' (secret chat id '.$secret_chat_id.') to accept the secret chat...'.PHP_EOL;

    $MadelineProto->sleep(10);

    /**
     * Send a markdown-formatted text message with expiration after 10 seconds.
     */
    $sentMessage = $MadelineProto->messages->sendEncrypted([
        'peer' => $secret_chat_id,
        'message' => [
            '_' => 'decryptedMessage',
            'media' => ['_' => 'decryptedMessageMediaEmpty'], // No media
            'ttl' => 10, // This message self-destructs 10 seconds after reception
            'message' => '```'.$message.'```', // Code Markdown
            'parse_mode' => 'Markdown',
        ],
    ]);
    $MadelineProto->logger($sentMessage, Logger::NOTICE);

    /**
     * Send secret media.
     */
    $secret_media = [];

    // Photo uploaded as document, secret chat
    $secret_media['document_photo'] = [
        'peer' => $secret_chat_id,
        'file' => __DIR__.'/faust.jpg', // The file to send
        'message' => [
            '_' => 'decryptedMessage',
            'ttl' => 0, // This message does not self-destruct
            'message' => '', // No text message, only media
            'media' => [
                '_' => 'decryptedMessageMediaDocument',
                'thumb' => file_get_contents(__DIR__.'/faust.preview.jpg'), // The thumbnail must be generated manually, it must be in jpg format, 90x90
                'thumb_w' => 90,
                'thumb_h' => 90,
                'mime_type' => mime_content_type(__DIR__.'/faust.jpg'), // The file's mime type
                'caption' => 'This file was uploaded using @MadelineProto', // The caption
                'file_name' => 'faust.jpg', // The file's name
                'size' => filesize(__DIR__.'/faust.jpg'), // The file's size
                'attributes' => [
                    ['_' => 'documentAttributeImageSize', 'w' => 1280, 'h' => 914], // Image's resolution
                ],
            ],
        ],
    ];

    // Photo, secret chat
    $secret_media['photo'] = [
        'peer' => $secret_chat_id,
        'file' => __DIR__.'/faust.jpg',
        'message' => [
            '_' => 'decryptedMessage',
            'ttl' => 0,
            'message' => '',
            'media' => [
                '_' => 'decryptedMessageMediaPhoto',
                'thumb' => file_get_contents(__DIR__.'/faust.preview.jpg'),
                'thumb_w' => 90,
                'thumb_h' => 90,
                'caption' => 'This file was uploaded using @MadelineProto',
                'size' => filesize(__DIR__.'/faust.jpg'),
                'w' => 1280,
                'h' => 914,
            ],
        ],
    ];

    // GIF, secret chat
    $secret_media['gif'] = ['peer' => $secret_chat_id, 'file' => __DIR__.'/pony.mp4', 'message' => ['_' => 'decryptedMessage', 'ttl' => 0, 'message' => '', 'media' => ['_' => 'decryptedMessageMediaDocument', 'thumb' => file_get_contents(__DIR__.'/pony.preview.jpg'), 'thumb_w' => 90, 'thumb_h' => 90, 'mime_type' => mime_content_type(__DIR__.'/pony.mp4'), 'caption' => 'test', 'file_name' => 'pony.mp4', 'size' => filesize(__DIR__.'/faust.jpg'), 'attributes' => [['_' => 'documentAttributeAnimated']]]]];

    // Sticker, secret chat
    $secret_media['sticker'] = ['peer' => $secret_chat_id, 'file' => __DIR__.'/lel.webp', 'message' => ['_' => 'decryptedMessage', 'ttl' => 0, 'message' => '', 'media' => ['_' => 'decryptedMessageMediaDocument', 'thumb' => file_get_contents(__DIR__.'/lel.preview.jpg'), 'thumb_w' => 90, 'thumb_h' => 90, 'mime_type' => mime_content_type(__DIR__.'/lel.webp'), 'caption' => 'test', 'file_name' => 'lel.webp', 'size' => filesize(__DIR__.'/lel.webp'), 'attributes' => [['_' => 'documentAttributeSticker', 'alt' => 'LEL', 'stickerset' => ['_' => 'inputStickerSetEmpty']]]]]];

    // Document, secret chat
    $secret_media['document'] = ['peer' => $secret_chat_id, 'file' => __DIR__.'/60', 'message' => ['_' => 'decryptedMessage', 'ttl' => 0, 'message' => '', 'media' => ['_' => 'decryptedMessageMediaDocument', 'thumb' => file_get_contents(__DIR__.'/faust.preview.jpg'), 'thumb_w' => 90, 'thumb_h' => 90, 'mime_type' => 'magic/magic', 'caption' => 'test', 'file_name' => 'magic.magic', 'size' => filesize(__DIR__.'/60'), 'attributes' => [['_' => 'documentAttributeFilename', 'file_name' => 'fairy']]]]];

    // Video, secret chat
    $secret_media['video'] = ['peer' => $secret_chat_id, 'file' => __DIR__.'/swing.mp4', 'message' => ['_' => 'decryptedMessage', 'ttl' => 0, 'message' => '', 'media' => ['_' => 'decryptedMessageMediaDocument', 'thumb' => file_get_contents(__DIR__.'/swing.preview.jpg'), 'thumb_w' => 90, 'thumb_h' => 90, 'mime_type' => mime_content_type(__DIR__.'/swing.mp4'), 'caption' => 'test', 'file_name' => 'swing.mp4', 'size' => filesize(__DIR__.'/swing.mp4'), 'attributes' => [['_' => 'documentAttributeVideo']]]]];

    // audio, secret chat
    $secret_media['audio'] = ['peer' => $secret_chat_id, 'file' => __DIR__.'/mosconi.mp3', 'message' => ['_' => 'decryptedMessage', 'ttl' => 0, 'message' => '', 'media' => ['_' => 'decryptedMessageMediaDocument', 'thumb' => file_get_contents(__DIR__.'/faust.preview.jpg'), 'thumb_w' => 90, 'thumb_h' => 90, 'mime_type' => mime_content_type(__DIR__.'/mosconi.mp3'), 'caption' => 'test', 'file_name' => 'mosconi.mp3', 'size' => filesize(__DIR__.'/mosconi.mp3'), 'attributes' => [['_' => 'documentAttributeAudio', 'voice' => false, 'title' => 'AH NON LO SO IO', 'performer' => 'IL DIO GERMANO MOSCONI']]]]];
    $secret_media['voice'] = ['peer' => $secret_chat_id, 'file' => __DIR__.'/mosconi.mp3', 'message' => ['_' => 'decryptedMessage', 'ttl' => 0, 'message' => '', 'media' => ['_' => 'decryptedMessageMediaDocument', 'thumb' => file_get_contents(__DIR__.'/faust.preview.jpg'), 'thumb_w' => 90, 'thumb_h' => 90, 'mime_type' => mime_content_type(__DIR__.'/mosconi.mp3'), 'caption' => 'test', 'file_name' => 'mosconi.mp3', 'size' => filesize(__DIR__.'/mosconi.mp3'), 'attributes' => [['_' => 'documentAttributeAudio', 'voice' => true, 'title' => 'AH NON LO SO IO', 'performer' => 'IL DIO GERMANO MOSCONI']]]]];

    foreach ($secret_media as $type => $smessage) {
        $MadelineProto->logger("Encrypting and uploading $type...");
        $type = $MadelineProto->messages->sendEncryptedFile($smessage);
    }
}

if (!getenv('TEST_USERNAME')) {
    throw new Exception('No TEST_USERNAME environment variable was provided!');
}
$mention = $MadelineProto->getInfo(getenv('TEST_USERNAME')); // Returns an array with all of the constructors that can be extracted from a username or an id
$mention = $mention['user_id']; // Selects only the numeric user id
$media = [];

// Image
$media['photo'] = ['_' => 'inputMediaUploadedPhoto', 'file' => __DIR__.'/faust.jpg'];

// Image by URL
$media['photo_url'] = ['_' => 'inputMediaPhotoExternal', 'url' => 'https://github.com/danog/MadelineProto/raw/v8/tests/faust.jpg'];

// Sticker
$media['sticker'] = ['_' => 'inputMediaUploadedDocument', 'file' => __DIR__.'/lel.webp', 'attributes' => [['_' => 'documentAttributeSticker', 'alt' => 'LEL']]];

// Video
$media['video'] = ['_' => 'inputMediaUploadedDocument', 'file' => __DIR__.'/swing.mp4', 'attributes' => [['_' => 'documentAttributeVideo']]];

// audio
$media['audio'] = ['_' => 'inputMediaUploadedDocument', 'file' => __DIR__.'/mosconi.mp3', 'attributes' => [['_' => 'documentAttributeAudio', 'voice' => false, 'title' => 'AH NON LO SO IO', 'performer' => 'IL DIO GERMANO MOSCONI']]];

// voice
$media['voice'] = ['_' => 'inputMediaUploadedDocument', 'file' => __DIR__.'/mosconi.mp3', 'attributes' => [['_' => 'documentAttributeAudio', 'voice' => true, 'title' => 'AH NON LO SO IO', 'performer' => 'IL DIO GERMANO MOSCONI']]];

// Document
$media['document'] = ['_' => 'inputMediaUploadedDocument', 'file' => __DIR__.'/60', 'mime_type' => 'magic/magic', 'attributes' => [['_' => 'documentAttributeFilename', 'file_name' => 'magic.magic']]];

// Document by URL
$media['document_url'] = ['_' => 'inputMediaDocumentExternal', 'url' => 'https://github.com/danog/MadelineProto/raw/v8/tests/60'];

$message = 'yay '.PHP_VERSION_ID;
$mention = $MadelineProto->getInfo(getenv('TEST_USERNAME')); // Returns an array with all of the constructors that can be extracted from a username or an id
$mention = $mention['user_id']; // Selects only the numeric user id

$peers = json_decode(getenv('TEST_DESTINATION_GROUPS'), true);
if (!$peers) {
    die("No TEST_DESTINATION_GROUPS array was provided!");
}

foreach ($media as &$inputMedia) {
    $inputMedia['content'] = isset($inputMedia['file'])
        ? read($inputMedia['file'])
        : $MadelineProto->fileGetContents($inputMedia['url']);
}

function eq(string $file, string $contents, string $type, string $subtype): void
{
    if ($type !== 'photo' && $type !== 'photo_url') {
        Assert::eq(read($file), $contents, "Not equal $type $subtype!");
    }
}

function sendMedia(API $MadelineProto, array $media, string $message, string $mention, mixed $peer, string $type): void
{
    $medias = [
        'base' => $media,
    ];
    if (isset($media['file']) && is_string($media['file'])) {
        $MadelineProto->sendDocument(
            peer: $peer,
            file: new ReadableBuffer(read($media['file'])),
            callback: static fn ($v) => $MadelineProto->logger($v),
            fileName: basename($media['file'])
        );
        $medias['callback'] = array_merge(
            $media,
            ['file' => new FileCallback($media['file'], static fn ($v) => $MadelineProto->logger(...))]
        );
        $medias['stream'] = array_merge(
            $media,
            ['file' => new ReadableBuffer(read($media['file']))]
        );
        $medias['callback stream'] = array_merge(
            $media,
            ['file' => new FileCallback(new ReadableBuffer(read($media['file'])), static fn ($v) => $MadelineProto->logger(...))]
        );
    } elseif (isset($media['url'])) {
        $medias['callback'] = array_merge(
            $media,
            ['url' => new FileCallback($media['url'], static fn ($v) => $MadelineProto->logger(...))]
        );
    }
    foreach ($medias as $subtype => $m) {
        $MadelineProto->logger("Sending $type $subtype");
        $dl = $MadelineProto->extractMessage($MadelineProto->messages->sendMedia(['peer' => $peer, 'media' => $m, 'message' => '['.$message.'](mention:'.$mention.')', 'parse_mode' => 'markdown']));

        $MadelineProto->logger("Downloading $type $subtype");
        $file = $MadelineProto->downloadToDir($dl, '/tmp');
        eq($file, $m['content'], $type, $subtype);
    }
}

foreach ($peers as $peer) {
    $sentMessage = $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $message, 'entities' => [['_' => 'inputMessageEntityMentionName', 'offset' => 0, 'length' => mb_strlen($message), 'user_id' => $mention]]]);
    $MadelineProto->logger($sentMessage, Logger::NOTICE);

    $sentMessage = $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => str_repeat('a', 4096*4)]);
    $MadelineProto->logger($sentMessage, \danog\MadelineProto\Logger::NOTICE);

    foreach ($media as $type => $inputMedia) {
        if ($type !== 'sticker' && $type !== 'voice') {
            $MadelineProto->logger("Sending multi $type");
            $MadelineProto->messages->sendMultiMedia(['peer' => $peer, 'multi_media' => [
                ['_' => 'inputSingleMedia', 'media' => $inputMedia, 'message' => '['.$message.'](mention:'.$mention.')', 'parse_mode' => 'markdown'],
                ['_' => 'inputSingleMedia', 'media' => $inputMedia, 'message' => '['.$message.'](mention:'.$mention.')', 'parse_mode' => 'markdown'],
            ]]);
        }

        sendMedia($MadelineProto, $inputMedia, $message, $mention, $peer, $type);

        $MadelineProto->logger("Uploading $type");
        $media = $MadelineProto->messages->uploadMedia(['peer' => '@me', 'media' => $inputMedia]);

        $MadelineProto->logger("Downloading $type");
        $file = $MadelineProto->downloadToDir($media, '/tmp');
        eq($file, $inputMedia['content'], $type, "upload");

        $MadelineProto->logger("Re-sending $type");
        $inputMedia['file'] = $media;

        $dl = $MadelineProto->messages->uploadMedia(['peer' => '@me', 'media' => $inputMedia]);

        $MadelineProto->logger("Re-downloading $type");
        $file = $MadelineProto->downloadToDir($dl, '/tmp');
        eq($file, $inputMedia['content'], $type, "re-upload");
    }
}

foreach (json_decode(getenv('TEST_DESTINATION_GROUPS'), true) as $peer) {
    $sentMessage = $MadelineProto->messages->sendMessage(['peer' => $peer, 'message' => $message, 'entities' => [['_' => 'inputMessageEntityMentionName', 'offset' => 0, 'length' => mb_strlen($message), 'user_id' => $mention]]]);
    $MadelineProto->logger($sentMessage, Logger::NOTICE);
}
