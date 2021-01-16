<?php

/**
 * uuid.php
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
 * Namespace used for fully-qualified domain names.
 */
define('UUID_NAMESPACE_DNS', '6ba7b810-9dad-11d1-80b4-00c04fd430c8');

/**
 * Namespace used for URLs.
 */
define('UUID_NAMESPACE_URL', '6ba7b811-9dad-11d1-80b4-00c04fd430c8');

/**
 * Namespace used for ISO OID strings.
 */
define('UUID_NAMESPACE_OID', '6ba7b812-9dad-11d1-80b4-00c04fd430c8');

/**
 * Namespace used for text output format.
 */
define('UUID_NAMESPACE_X500', '6ba7b814-9dad-11d1-80b4-00c04fd430c8');

/**
 * NIL UUID with all bits set to 0.
 */
define('UUID_NAMESPACE_NIL', '00000000-0000-0000-0000-000000000000');

/**
 * Generate a UUID using cryptographically secure pseudo-random
 * number generation algorithms. This method corresponds to the 4th version
 * of the UUID RFC 4122 specification.
 *
 * @return string
 * @throws Exception
 */
function uuid_generate_random(): string
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        random_int(0, 0xffff),
        random_int(0, 0xffff),
        random_int(0, 0xffff),
        random_int(0, 0x0fff) | 0x4000,
        random_int(0, 0x3fff) | 0x8000,
        random_int(0, 0xffff),
        random_int(0, 0xffff),
        random_int(0, 0xffff)
    );
}
