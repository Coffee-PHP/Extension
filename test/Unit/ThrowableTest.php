<?php

/**
 * ThrowableTest.php
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

declare (strict_types=1);

namespace CoffeePhp\Extension\Test\Unit;


use Exception;
use PHPUnit\Framework\TestCase;

use function mt_rand;
use function PHPUnit\Framework\assertTrue;
use function strlen;
use function throwable_get_trace_as_string;
use function uniqid;

/**
 * Class ThrowableTest
 * @package coffeephp\extension
 * @since 2020-08-11
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class ThrowableTest extends TestCase
{
    public function testGetTraceAsString(): void
    {
        $exception = new Exception(uniqid('', true), mt_rand());
        assertTrue(
            strlen(throwable_get_trace_as_string($exception)) >=
            strlen($exception->getTraceAsString()),
            throwable_get_trace_as_string($exception) . PHP_EOL . PHP_EOL .
            $exception->getTraceAsString()
        );
    }
}
