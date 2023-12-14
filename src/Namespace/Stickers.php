<?php declare(strict_types=1);
/**
 * This file is automatic generated by build_docs.php file
 * and is used only for autocomplete in multiple IDE
 * don't modify manually.
 */

namespace danog\MadelineProto\Namespace;

interface Stickers
{
    /**
     * Create a stickerset, bots only.
     *
     * @param bool $masks Whether this is a mask stickerset
     * @param bool $animated Whether this is an animated stickerset
     * @param bool $videos Whether this is a video stickerset
     * @param bool $emojis Whether this is a [custom emoji](https://core.telegram.org/api/custom-emoji) stickerset.
     * @param bool $text_color Whether the color of TGS custom emojis contained in this set should be changed to the text color when used in messages, the accent color if used as emoji status, white on chat photos, or another appropriate color based on context. For custom emoji stickersets only.
     * @param array|int|string $user_id Stickerset owner @see https://docs.madelineproto.xyz/API_docs/types/InputUser.html
     * @param string $title Stickerset name, `1-64` chars
     * @param string $short_name Short name of sticker set, to be used in [sticker deep links »](https://core.telegram.org/api/links#stickerset-links). Can contain only english letters, digits and underscores. Must begin with a letter, can't contain consecutive underscores and, **if called by a bot**, must end in `"_by_<bot_username>"`. `<bot_username>` is case insensitive. 1-64 characters.
     * @param array $thumb Thumbnail @see https://docs.madelineproto.xyz/API_docs/types/InputDocument.html
     * @param list<array{_: 'inputStickerSetItem', document?: array, emoji?: string, mask_coords?: array{_: 'maskCoords', x: float, y: float, zoom: float, n?: int}, keywords?: string}>|array<never, never> $stickers Array of Stickers @see https://docs.madelineproto.xyz/API_docs/types/InputStickerSetItem.html
     * @param string $software Used when [importing stickers using the sticker import SDKs](https://core.telegram.org/import-stickers), specifies the name of the software that created the stickers
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'messages.stickerSet', set: array{_: 'stickerSet', archived: bool, official: bool, masks: bool, animated: bool, videos: bool, emojis: bool, text_color: bool, installed_date: int, id: int, access_hash: int, title: string, short_name: string, thumbs: list<array{_: 'photoSizeEmpty', type: string}|array{_: 'photoSize', type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', type: string, w: int, h: int, bytes: string}|array{_: 'photoStrippedSize', type: string, bytes: string}|array{_: 'photoSizeProgressive', type: string, w: int, h: int, sizes: list<int>}|array{_: 'photoPathSize', type: string, bytes: string}|array{_: 'photoSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, bytes: string}>, thumb_dc_id: int, thumb_version: int, thumb_document_id: int, count: int, hash: int}, packs: list<array{_: 'stickerPack', emoticon: string, documents: list<int>}>, keywords: list<array{_: 'stickerKeyword', document_id: int, keyword: list<string>}>, documents: list<array{_: 'documentEmpty', id: array}|array{_: 'document', id: array, access_hash: array, file_reference: array, date: array, mime_type: array, size: array, thumbs: list<array>, video_thumbs: list<array>, dc_id: array, attributes: list<array>}>}|array{_: 'messages.stickerSetNotModified'} @see https://docs.madelineproto.xyz/API_docs/types/messages.StickerSet.html
     */
    public function createStickerSet(bool|null $masks = false, bool|null $animated = false, bool|null $videos = false, bool|null $emojis = false, bool|null $text_color = false, array|int|string|null $user_id = null, string|null $title = '', string|null $short_name = '', array|null $thumb = null, array $stickers = [], string|null $software = '', ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Remove a sticker from the set where it belongs, bots only. The sticker set must have been created by the bot.
     *
     * @param array $sticker The sticker to remove @see https://docs.madelineproto.xyz/API_docs/types/InputDocument.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'messages.stickerSet', set: array{_: 'stickerSet', archived: bool, official: bool, masks: bool, animated: bool, videos: bool, emojis: bool, text_color: bool, installed_date: int, id: int, access_hash: int, title: string, short_name: string, thumbs: list<array{_: 'photoSizeEmpty', type: string}|array{_: 'photoSize', type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', type: string, w: int, h: int, bytes: string}|array{_: 'photoStrippedSize', type: string, bytes: string}|array{_: 'photoSizeProgressive', type: string, w: int, h: int, sizes: list<int>}|array{_: 'photoPathSize', type: string, bytes: string}|array{_: 'photoSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, bytes: string}>, thumb_dc_id: int, thumb_version: int, thumb_document_id: int, count: int, hash: int}, packs: list<array{_: 'stickerPack', emoticon: string, documents: list<int>}>, keywords: list<array{_: 'stickerKeyword', document_id: int, keyword: list<string>}>, documents: list<array{_: 'documentEmpty', id: array}|array{_: 'document', id: array, access_hash: array, file_reference: array, date: array, mime_type: array, size: array, thumbs: list<array>, video_thumbs: list<array>, dc_id: array, attributes: list<array>}>}|array{_: 'messages.stickerSetNotModified'} @see https://docs.madelineproto.xyz/API_docs/types/messages.StickerSet.html
     */
    public function removeStickerFromSet(array|null $sticker = null, ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Changes the absolute position of a sticker in the set to which it belongs; for bots only. The sticker set must have been created by the bot.
     *
     * @param array $sticker The sticker @see https://docs.madelineproto.xyz/API_docs/types/InputDocument.html
     * @param int $position The new position of the sticker, zero-based
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'messages.stickerSet', set: array{_: 'stickerSet', archived: bool, official: bool, masks: bool, animated: bool, videos: bool, emojis: bool, text_color: bool, installed_date: int, id: int, access_hash: int, title: string, short_name: string, thumbs: list<array{_: 'photoSizeEmpty', type: string}|array{_: 'photoSize', type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', type: string, w: int, h: int, bytes: string}|array{_: 'photoStrippedSize', type: string, bytes: string}|array{_: 'photoSizeProgressive', type: string, w: int, h: int, sizes: list<int>}|array{_: 'photoPathSize', type: string, bytes: string}|array{_: 'photoSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, bytes: string}>, thumb_dc_id: int, thumb_version: int, thumb_document_id: int, count: int, hash: int}, packs: list<array{_: 'stickerPack', emoticon: string, documents: list<int>}>, keywords: list<array{_: 'stickerKeyword', document_id: int, keyword: list<string>}>, documents: list<array{_: 'documentEmpty', id: array}|array{_: 'document', id: array, access_hash: array, file_reference: array, date: array, mime_type: array, size: array, thumbs: list<array>, video_thumbs: list<array>, dc_id: array, attributes: list<array>}>}|array{_: 'messages.stickerSetNotModified'} @see https://docs.madelineproto.xyz/API_docs/types/messages.StickerSet.html
     */
    public function changeStickerPosition(array|null $sticker = null, int|null $position = 0, ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Add a sticker to a stickerset, bots only. The sticker set must have been created by the bot.
     *
     * @param array{_: 'inputStickerSetItem', document?: array, emoji?: string, mask_coords?: array{_: 'maskCoords', x: float, y: float, zoom: float, n?: int}, keywords?: string} $sticker The sticker @see https://docs.madelineproto.xyz/API_docs/types/InputStickerSetItem.html
     * @param array{_: 'inputStickerSetEmpty'}|array{_: 'inputStickerSetID', id?: int, access_hash?: int}|array{_: 'inputStickerSetShortName', short_name?: string}|array{_: 'inputStickerSetAnimatedEmoji'}|array{_: 'inputStickerSetDice', emoticon?: string}|array{_: 'inputStickerSetAnimatedEmojiAnimations'}|array{_: 'inputStickerSetPremiumGifts'}|array{_: 'inputStickerSetEmojiGenericAnimations'}|array{_: 'inputStickerSetEmojiDefaultStatuses'}|array{_: 'inputStickerSetEmojiDefaultTopicIcons'} $stickerset The stickerset @see https://docs.madelineproto.xyz/API_docs/types/InputStickerSet.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'messages.stickerSet', set: array{_: 'stickerSet', archived: bool, official: bool, masks: bool, animated: bool, videos: bool, emojis: bool, text_color: bool, installed_date: int, id: int, access_hash: int, title: string, short_name: string, thumbs: list<array{_: 'photoSizeEmpty', type: string}|array{_: 'photoSize', type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', type: string, w: int, h: int, bytes: string}|array{_: 'photoStrippedSize', type: string, bytes: string}|array{_: 'photoSizeProgressive', type: string, w: int, h: int, sizes: list<int>}|array{_: 'photoPathSize', type: string, bytes: string}|array{_: 'photoSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, bytes: string}>, thumb_dc_id: int, thumb_version: int, thumb_document_id: int, count: int, hash: int}, packs: list<array{_: 'stickerPack', emoticon: string, documents: list<int>}>, keywords: list<array{_: 'stickerKeyword', document_id: int, keyword: list<string>}>, documents: list<array{_: 'documentEmpty', id: array}|array{_: 'document', id: array, access_hash: array, file_reference: array, date: array, mime_type: array, size: array, thumbs: list<array>, video_thumbs: list<array>, dc_id: array, attributes: list<array>}>}|array{_: 'messages.stickerSetNotModified'} @see https://docs.madelineproto.xyz/API_docs/types/messages.StickerSet.html
     */
    public function addStickerToSet(array $sticker, array|null $stickerset = null, ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Set stickerset thumbnail.
     *
     * @param array{_: 'inputStickerSetEmpty'}|array{_: 'inputStickerSetID', id?: int, access_hash?: int}|array{_: 'inputStickerSetShortName', short_name?: string}|array{_: 'inputStickerSetAnimatedEmoji'}|array{_: 'inputStickerSetDice', emoticon?: string}|array{_: 'inputStickerSetAnimatedEmojiAnimations'}|array{_: 'inputStickerSetPremiumGifts'}|array{_: 'inputStickerSetEmojiGenericAnimations'}|array{_: 'inputStickerSetEmojiDefaultStatuses'}|array{_: 'inputStickerSetEmojiDefaultTopicIcons'} $stickerset Stickerset @see https://docs.madelineproto.xyz/API_docs/types/InputStickerSet.html
     * @param array $thumb Thumbnail (only for normal stickersets, not custom emoji stickersets). @see https://docs.madelineproto.xyz/API_docs/types/InputDocument.html
     * @param int $thumb_document_id Only for [custom emoji stickersets](https://core.telegram.org/api/custom-emoji), ID of a custom emoji present in the set to use as thumbnail; pass 0 to fallback to the first custom emoji of the set.
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'messages.stickerSet', set: array{_: 'stickerSet', archived: bool, official: bool, masks: bool, animated: bool, videos: bool, emojis: bool, text_color: bool, installed_date: int, id: int, access_hash: int, title: string, short_name: string, thumbs: list<array{_: 'photoSizeEmpty', type: string}|array{_: 'photoSize', type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', type: string, w: int, h: int, bytes: string}|array{_: 'photoStrippedSize', type: string, bytes: string}|array{_: 'photoSizeProgressive', type: string, w: int, h: int, sizes: list<int>}|array{_: 'photoPathSize', type: string, bytes: string}|array{_: 'photoSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, bytes: string}>, thumb_dc_id: int, thumb_version: int, thumb_document_id: int, count: int, hash: int}, packs: list<array{_: 'stickerPack', emoticon: string, documents: list<int>}>, keywords: list<array{_: 'stickerKeyword', document_id: int, keyword: list<string>}>, documents: list<array{_: 'documentEmpty', id: array}|array{_: 'document', id: array, access_hash: array, file_reference: array, date: array, mime_type: array, size: array, thumbs: list<array>, video_thumbs: list<array>, dc_id: array, attributes: list<array>}>}|array{_: 'messages.stickerSetNotModified'} @see https://docs.madelineproto.xyz/API_docs/types/messages.StickerSet.html
     */
    public function setStickerSetThumb(array|null $stickerset = null, array|null $thumb = null, int|null $thumb_document_id = 0, ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Check whether the given short name is available.
     *
     * @param string $short_name Short name
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function checkShortName(string|null $short_name = '', ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;

    /**
     * Suggests a short name for a given stickerpack name.
     *
     * @param string $title Sticker pack name
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'stickers.suggestedShortName', short_name: string} @see https://docs.madelineproto.xyz/API_docs/types/stickers.SuggestedShortName.html
     */
    public function suggestShortName(string|null $title = '', ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Update the keywords, emojis or [mask coordinates](https://core.telegram.org/api/stickers#mask-stickers) of a sticker, bots only.
     *
     * @param array $sticker The sticker @see https://docs.madelineproto.xyz/API_docs/types/InputDocument.html
     * @param string $emoji If set, updates the emoji list associated to the sticker
     * @param array{_: 'maskCoords', x: float, y: float, zoom: float, n?: int} $mask_coords If set, updates the [mask coordinates](https://core.telegram.org/api/stickers#mask-stickers) @see https://docs.madelineproto.xyz/API_docs/types/MaskCoords.html
     * @param string $keywords If set, updates the sticker keywords (separated by commas). Can't be provided for mask stickers.
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'messages.stickerSet', set: array{_: 'stickerSet', archived: bool, official: bool, masks: bool, animated: bool, videos: bool, emojis: bool, text_color: bool, installed_date: int, id: int, access_hash: int, title: string, short_name: string, thumbs: list<array{_: 'photoSizeEmpty', type: string}|array{_: 'photoSize', type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', type: string, w: int, h: int, bytes: string}|array{_: 'photoStrippedSize', type: string, bytes: string}|array{_: 'photoSizeProgressive', type: string, w: int, h: int, sizes: list<int>}|array{_: 'photoPathSize', type: string, bytes: string}|array{_: 'photoSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, bytes: string}>, thumb_dc_id: int, thumb_version: int, thumb_document_id: int, count: int, hash: int}, packs: list<array{_: 'stickerPack', emoticon: string, documents: list<int>}>, keywords: list<array{_: 'stickerKeyword', document_id: int, keyword: list<string>}>, documents: list<array{_: 'documentEmpty', id: array}|array{_: 'document', id: array, access_hash: array, file_reference: array, date: array, mime_type: array, size: array, thumbs: list<array>, video_thumbs: list<array>, dc_id: array, attributes: list<array>}>}|array{_: 'messages.stickerSetNotModified'} @see https://docs.madelineproto.xyz/API_docs/types/messages.StickerSet.html
     */
    public function changeSticker(array|null $sticker = null, string|null $emoji = '', array|null $mask_coords = null, string|null $keywords = '', ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Renames a stickerset, bots only.
     *
     * @param array{_: 'inputStickerSetEmpty'}|array{_: 'inputStickerSetID', id?: int, access_hash?: int}|array{_: 'inputStickerSetShortName', short_name?: string}|array{_: 'inputStickerSetAnimatedEmoji'}|array{_: 'inputStickerSetDice', emoticon?: string}|array{_: 'inputStickerSetAnimatedEmojiAnimations'}|array{_: 'inputStickerSetPremiumGifts'}|array{_: 'inputStickerSetEmojiGenericAnimations'}|array{_: 'inputStickerSetEmojiDefaultStatuses'}|array{_: 'inputStickerSetEmojiDefaultTopicIcons'} $stickerset Stickerset to rename @see https://docs.madelineproto.xyz/API_docs/types/InputStickerSet.html
     * @param string $title New stickerset title
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'messages.stickerSet', set: array{_: 'stickerSet', archived: bool, official: bool, masks: bool, animated: bool, videos: bool, emojis: bool, text_color: bool, installed_date: int, id: int, access_hash: int, title: string, short_name: string, thumbs: list<array{_: 'photoSizeEmpty', type: string}|array{_: 'photoSize', type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', type: string, w: int, h: int, bytes: string}|array{_: 'photoStrippedSize', type: string, bytes: string}|array{_: 'photoSizeProgressive', type: string, w: int, h: int, sizes: list<int>}|array{_: 'photoPathSize', type: string, bytes: string}|array{_: 'photoSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, size: int}|array{_: 'photoCachedSize', location: array{_: 'fileLocationUnavailable', volume_id: int, local_id: int, secret: int}|array{_: 'fileLocation', dc_id: int, volume_id: int, local_id: int, secret: int}, type: string, w: int, h: int, bytes: string}>, thumb_dc_id: int, thumb_version: int, thumb_document_id: int, count: int, hash: int}, packs: list<array{_: 'stickerPack', emoticon: string, documents: list<int>}>, keywords: list<array{_: 'stickerKeyword', document_id: int, keyword: list<string>}>, documents: list<array{_: 'documentEmpty', id: array}|array{_: 'document', id: array, access_hash: array, file_reference: array, date: array, mime_type: array, size: array, thumbs: list<array>, video_thumbs: list<array>, dc_id: array, attributes: list<array>}>}|array{_: 'messages.stickerSetNotModified'} @see https://docs.madelineproto.xyz/API_docs/types/messages.StickerSet.html
     */
    public function renameStickerSet(array|null $stickerset = null, string|null $title = '', ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Deletes a stickerset we created, bots only.
     *
     * @param array{_: 'inputStickerSetEmpty'}|array{_: 'inputStickerSetID', id?: int, access_hash?: int}|array{_: 'inputStickerSetShortName', short_name?: string}|array{_: 'inputStickerSetAnimatedEmoji'}|array{_: 'inputStickerSetDice', emoticon?: string}|array{_: 'inputStickerSetAnimatedEmojiAnimations'}|array{_: 'inputStickerSetPremiumGifts'}|array{_: 'inputStickerSetEmojiGenericAnimations'}|array{_: 'inputStickerSetEmojiDefaultStatuses'}|array{_: 'inputStickerSetEmojiDefaultTopicIcons'} $stickerset Stickerset to delete @see https://docs.madelineproto.xyz/API_docs/types/InputStickerSet.html
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     */
    public function deleteStickerSet(array|null $stickerset = null, ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): bool;
}
