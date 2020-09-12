<?php

/**
 * throwable.php
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

if (!function_exists('throwable_get_trace_as_string')) {
    /**
     * Same as {@see Throwable::getTraceAsString()} but
     * does not truncate the output.
     *
     * @param Throwable $t
     * @param string $frameSeparator
     * @return string
     */
    function throwable_get_trace_as_string(Throwable $t, string $frameSeparator = PHP_EOL): string
    {
        $rtn = '';
        $count = 0;
        /**
         * @var int $count
         * @var array $frame
         */
        foreach ($t->getTrace() as $count => $frame) {
            $args = '';
            /** @var mixed $arg */
            foreach ($frame['args'] ?? [] as $arg) {
                switch (true) {
                    case is_string($arg):
                        $arg = "'$arg'";
                        break;
                    case is_array($arg):
                        $arg = 'Array';
                        break;
                    case is_null($arg):
                        $arg = 'NULL';
                        break;
                    case is_object($arg):
                        $arg = 'Object(' . get_class($arg) . ')';
                        break;
                    case is_resource($arg):
                        $arg = get_resource_type($arg);
                        break;
                }
                $args .= "$arg, ";
            }
            $args = (string)substr($args, 0, -2);
            $currentFile = isset($frame['file']) ? (string)$frame['file'] : '[internal function]';
            $currentLine = isset($frame['line']) ? "({$frame['line']})" : '';
            $functionStr =
                (isset($frame['class']) ? (string)$frame['class'] : '') .
                (isset($frame['type']) ? (string)$frame['type'] : '') .
                (isset($frame['function']) ? (string)$frame['function'] : '');
            $rtn .= "#{$count} {$currentFile}{$currentLine}: {$functionStr}({$args}){$frameSeparator}";
        }
        ++$count;
        return "{$rtn}#{$count} {main}";
    }
}
