<?php

/**
 * mbstring.php
 *
 * Copyright 2020 Danny Damsky
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package coffeephp\extension
 * @author Danny Damsky <dannydamsky99@gmail.com>
 * @since 2020-08-11
 */

declare(strict_types=1);

if (!function_exists('mb_str_contains')) {
    /**
     * Check whether a string (the haystack) contains
     * another string (the needle).
     *
     * @param string $haystack
     * @param string $needle
     * @return bool
     * @noinspection StrContainsCanBeUsedInspection
     */
    function mb_str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== mb_strpos($haystack, $needle);
    }
}

if (!function_exists('mb_str_icontains')) {
    /**
     * Check whether a string (the haystack) contains
     * another string (the needle). (Multi-byte case-insensitive variant)
     *
     * @param string $haystack
     * @param string $needle
     * @param string|null $encoding
     * @return bool
     */
    function mb_str_icontains(string $haystack, string $needle, ?string $encoding = null): bool
    {
        if ($needle === '') {
            return true;
        }
        if ($encoding === null) {
            return mb_stripos($haystack, $needle) !== false;
        }
        return mb_stripos($haystack, $needle, 0, $encoding) !== false;
    }
}
