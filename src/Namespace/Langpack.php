<?php declare(strict_types=1);
/**
 * This file is automatic generated by build_docs.php file
 * and is used only for autocomplete in multiple IDE
 * don't modify manually.
 */

namespace danog\MadelineProto\Namespace;

interface Langpack
{
    /**
     * Get localization pack strings.
     *
     * @param string $lang_pack Language pack name, usually obtained from a [language pack link](https://core.telegram.org/api/links#language-pack-links)
     * @param string $lang_code Language code
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'langPackDifference', lang_code: string, from_version: int, version: int, strings: list<array{_: 'langPackString', key: string, value: string}|array{_: 'langPackStringPluralized', key: string, zero_value: string, one_value: string, two_value: string, few_value: string, many_value: string, other_value: string}|array{_: 'langPackStringDeleted', key: string}>} @see https://docs.madelineproto.xyz/API_docs/types/LangPackDifference.html
     */
    public function getLangPack(string|null $lang_pack = '', string|null $lang_code = '', ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Get strings from a language pack.
     *
     * @param string $lang_pack Language pack name, usually obtained from a [language pack link](https://core.telegram.org/api/links#language-pack-links)
     * @param string $lang_code Language code
     * @param list<string>|array<never, never> $keys Strings to get
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return list<array{_: 'langPackString', key: string, value: string}|array{_: 'langPackStringPluralized', key: string, zero_value: string, one_value: string, two_value: string, few_value: string, many_value: string, other_value: string}|array{_: 'langPackStringDeleted', key: string}> Array of  @see https://docs.madelineproto.xyz/API_docs/types/LangPackString.html
     */
    public function getStrings(string|null $lang_pack = '', string|null $lang_code = '', array $keys = [], ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array|null;

    /**
     * Get new strings in language pack.
     *
     * @param string $lang_pack Language pack
     * @param string $lang_code Language code
     * @param int $from_version Previous localization pack version
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'langPackDifference', lang_code: string, from_version: int, version: int, strings: list<array{_: 'langPackString', key: string, value: string}|array{_: 'langPackStringPluralized', key: string, zero_value: string, one_value: string, two_value: string, few_value: string, many_value: string, other_value: string}|array{_: 'langPackStringDeleted', key: string}>} @see https://docs.madelineproto.xyz/API_docs/types/LangPackDifference.html
     */
    public function getDifference(string|null $lang_pack = '', string|null $lang_code = '', int|null $from_version = 0, ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;

    /**
     * Get information about all languages in a localization pack.
     *
     * @param string $lang_pack Language pack
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return list<array{_: 'langPackLanguage', official: bool, rtl: bool, beta: bool, name: string, native_name: string, lang_code: string, base_lang_code: string, plural_code: string, strings_count: int, translated_count: int, translations_url: string}> Array of  @see https://docs.madelineproto.xyz/API_docs/types/LangPackLanguage.html
     */
    public function getLanguages(string|null $lang_pack = '', ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array|null;

    /**
     * Get information about a language in a localization pack.
     *
     * @param string $lang_pack Language pack name, usually obtained from a [language pack link](https://core.telegram.org/api/links#language-pack-links)
     * @param string $lang_code Language code
     * @param ?int $floodWaitLimit Can be used to specify a custom flood wait limit: if a FLOOD_WAIT_ rate limiting error is received with a waiting period bigger than this integer, an RPCErrorException will be thrown; otherwise, MadelineProto will simply wait for the specified amount of time. Defaults to the value specified in the settings: https://docs.madelineproto.xyz/PHP/danog/MadelineProto/Settings/RPC.html#setfloodtimeout-int-floodtimeout-self
     * @param ?string $queueId If specified, ensures strict server-side execution order of concurrent calls with the same queue ID.
     * @param ?\Amp\Cancellation $cancellation Cancellation
     * @return array{_: 'langPackLanguage', official: bool, rtl: bool, beta: bool, name: string, native_name: string, lang_code: string, base_lang_code: string, plural_code: string, strings_count: int, translated_count: int, translations_url: string} @see https://docs.madelineproto.xyz/API_docs/types/LangPackLanguage.html
     */
    public function getLanguage(string|null $lang_pack = '', string|null $lang_code = '', ?int $floodWaitLimit = null, ?string $queueId = null, ?\Amp\Cancellation $cancellation = null): array;
}
