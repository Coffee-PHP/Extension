<?php

/**
 * ArrayTest.php
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
 * @since 2020-08-12
 */

declare(strict_types=1);

namespace CoffeePhp\Extension\Test\Unit;

use CoffeePhp\QualityTools\TestCase;
use Exception;
use stdClass;
use TypeError;

use function fopen;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNull;

/**
 * Class ArrayTest
 * @package coffeephp\extension
 * @since 2020-08-12
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class ArrayTest extends TestCase
{
    /**
     * Logic is already tested in {@see VarTest},
     * just test that the functions work.
     * @throws Exception
     */
    public function testBasicFunctionality(): void
    {
        $array = [
            'int' => 5,
            'string' => 'string',
            'float' => 5.5,
            'bool' => true,
            'object' => new stdClass(),
            'resource' => fopen(__FILE__, 'rb'),
            'array' => [],
            'callable' => fn() => 1,
        ];

        foreach ($array as $key => $value) {
            $fn = "array_get_{$key}";
            $optionalFn = "array_get_optional_{$key}";
            assertEquals($value, $fn($array, $key));
            assertEquals($value, $optionalFn($array, $key));
            assertNull($optionalFn($array, $key . '1234'),);
            self::assertException(fn() => $fn($array, $key . '1234'), TypeError::class);
        }
    }
}
