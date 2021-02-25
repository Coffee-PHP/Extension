<?php

/**
 * random.php
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
 * @since 2021-01-08
 */

declare(strict_types=1);

/**
 * Generates a pseudo-randomly generated boolean value.
 *
 * @return bool
 * @throws Exception
 */
function random_bool(): bool
{
    return random_int(0, 1) === 1;
}

/**
 * Generates cryptographically secure pseudo-random floating
 * point values between 0 and 1.
 *
 * @return float
 * @throws Exception
 */
function random_float(): float
{
    return random_int(0, PHP_INT_MAX) / PHP_INT_MAX;
}

/**
 * Generates a cryptographically secure pseudo-random string.
 *
 * @param int $minLength The minimum length of the string.
 * @param int|null $maxLength The maximum length of the string. If not provided it will be equal to minLength.
 * @return string
 * @throws Exception
 */
function random_string(int $minLength, ?int $maxLength = null): string
{
    $maxLength ??= $minLength;
    if ($minLength < 1) {
        throw new Error('random_string(): Argument #1 ($minLength) must be greater than 0');
    }
    if ($maxLength < $minLength) {
        throw new Error('random_string(): Argument #2 ($maxLength) must be greater than Argument #1 ($minLength)');
    }
    $length = random_int($minLength, $maxLength);
    $bytesLength = (int)round($length * 0.5);
    $bytes = random_bytes($bytesLength);
    $string = bin2hex($bytes);
    return substr($string, 0, $length);
}
