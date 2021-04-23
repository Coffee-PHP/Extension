<?php

/**
 * string.php
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

/**
 * Format the given fields to CSV and return the CSV string.
 *
 * @param array $fields
 * @param string $delimiter
 * @param string $enclosure
 * @return string|false
 */
function str_putcsv(array $fields, string $delimiter = ',', string $enclosure = '"'): string|false
{
    try {
        $handle = fopen('php://temp', 'r+b');
        if ($handle === false) {
            return false;
        }
        fputcsv($handle, $fields, $delimiter, $enclosure);
        rewind($handle);
        return stream_get_contents($handle);
    } finally {
        if (isset($handle) && $handle !== false) {
            fclose($handle);
        }
    }
}
