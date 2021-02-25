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
use stdClass;
use TypeError;

use function array_get_array;
use function array_get_bool;
use function array_get_callable;
use function array_get_float;
use function array_get_int;
use function array_get_object;
use function array_get_optional_array;
use function array_get_optional_bool;
use function array_get_optional_callable;
use function array_get_optional_float;
use function array_get_optional_int;
use function array_get_optional_object;
use function array_get_optional_resource;
use function array_get_optional_string;
use function array_get_resource;
use function array_get_string;
use function fopen;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertIsCallable;
use function PHPUnit\Framework\assertIsObject;
use function PHPUnit\Framework\assertIsResource;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;

/**
 * Class ArrayTest
 * @package coffeephp\extension
 * @since 2020-08-12
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class ArrayTest extends TestCase
{
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

    /**
     * @see array_get_optional_string()
     */
    public function testArrayGetOptionalString(): void
    {
        assertSame('string', array_get_optional_string(['a' => 'string'], 'a'));
        assertNull(array_get_optional_string(['a' => null], 'a'));
        assertNull(array_get_optional_string(['a' => 2], 'a'));
        assertNull(array_get_optional_string(['a' => 8.52], 'a'));
        assertNull(array_get_optional_string(['a' => new stdClass()], 'a'));
        assertNull(array_get_optional_string(['a' => []], 'a'));
        assertNull(array_get_optional_string(['a' => fopen(__FILE__, 'rb')], 'a'));
        assertNull(array_get_optional_string(['a' => false], 'a'));
    }

    /**
     * @see array_get_string()
     */
    public function testArrayGetString(): void
    {
        assertSame('string', array_get_string(['string'], 0));
        self::assertException(fn() => array_get_string([null], 0), TypeError::class);
        self::assertException(fn() => array_get_string([2], 0), TypeError::class);
        self::assertException(fn() => array_get_string([8.52], 0), TypeError::class);
        self::assertException(fn() => array_get_string([new stdClass()], 0), TypeError::class);
        self::assertException(fn() => array_get_string([[]], 0), TypeError::class);
        self::assertException(fn() => array_get_string([fopen(__FILE__, 'rb')], 0), TypeError::class);
        self::assertException(fn() => array_get_string([false], 0), TypeError::class);
    }

    /**
     * @see array_get_optional_int()
     */
    public function testArrayGetOptionalInt(): void
    {
        assertSame(150, array_get_optional_int(['a' => 150], 'a'));
        assertNull(array_get_optional_int(['a' => 150.5], 'a'));
        assertNull(array_get_optional_int(['a' => false], 'a'));
        assertNull(array_get_optional_int(['a' => 'string'], 'a'));
        assertNull(array_get_optional_int(['a' => null], 'a'));
        assertNull(array_get_optional_int(['a' => new stdClass()], 'a'));
        assertNull(array_get_optional_int(['a' => []], 'a'));
        assertNull(array_get_optional_int(['a' => fopen(__FILE__, 'rb')], 'a'));
    }

    /**
     * @see array_get_int()
     */
    public function testArrayGetInt(): void
    {
        assertSame(150, array_get_int([150], 0));
        self::assertException(fn() => array_get_int([150.5], 0), TypeError::class);
        self::assertException(fn() => array_get_int([false], 0), TypeError::class);
        self::assertException(fn() => array_get_int(['string'], 0), TypeError::class);
        self::assertException(fn() => array_get_int([null], 0), TypeError::class);
        self::assertException(fn() => array_get_int([new stdClass()], 0), TypeError::class);
        self::assertException(fn() => array_get_int([[]], 0), TypeError::class);
        self::assertException(fn() => array_get_int([fopen(__FILE__, 'rb')], 0), TypeError::class);
    }

    /**
     * @see array_get_optional_float()
     */
    public function testArrayGetOptionalFloat(): void
    {
        assertSame(150.5, array_get_optional_float(['a' => 150.5], 'a'));
        assertSame(150.0, array_get_optional_float(['a' => 150], 'a'));
        assertNull(array_get_optional_float(['a' => false], 'a'));
        assertNull(array_get_optional_float(['a' => 'string'], 'a'));
        assertNull(array_get_optional_float(['a' => null], 'a'));
        assertNull(array_get_optional_float(['a' => new stdClass()], 'a'));
        assertNull(array_get_optional_float(['a' => []], 'a'));
        assertNull(array_get_optional_float(['a' => fopen(__FILE__, 'rb')], 'a'));
    }

    /**
     * @see array_get_float()
     */
    public function testArrayGetFloat(): void
    {
        assertSame(150.5, array_get_float([150.5], 0));
        assertSame(150.0, array_get_float([150], 0));
        self::assertException(fn() => array_get_float([false], 0), TypeError::class);
        self::assertException(fn() => array_get_float(['string'], 0), TypeError::class);
        self::assertException(fn() => array_get_float([null], 0), TypeError::class);
        self::assertException(fn() => array_get_float([new stdClass()], 0), TypeError::class);
        self::assertException(fn() => array_get_float([[]], 0), TypeError::class);
        self::assertException(fn() => array_get_float([fopen(__FILE__, 'rb')], 0), TypeError::class);
    }

    /**
     * @see array_get_optional_bool()
     */
    public function tesArrayGetOptionalBool(): void
    {
        assertTrue(array_get_optional_bool(['a' => true], 'a'));
        assertTrue(array_get_optional_bool(['a' => 1], 'a'));
        assertTrue(array_get_optional_bool(['a' => 'YES'], 'a'));
        assertTrue(array_get_optional_bool(['a' => 'TRUE'], 'a'));
        assertTrue(array_get_optional_bool(['a' => '1'], 'a'));
        assertFalse(array_get_optional_bool(['a' => false], 'a'));
        assertFalse(array_get_optional_bool(['a' => 0], 'a'));
        assertFalse(array_get_optional_bool(['a' => 'NO'], 'a'));
        assertFalse(array_get_optional_bool(['a' => 'FALSE'], 'a'));
        assertFalse(array_get_optional_bool(['a' => '0'], 'a'));
        assertNull(array_get_optional_bool(['a' => 150.5], 'a'));
        assertNull(array_get_optional_bool(['a' => 150], 'a'));
        assertNull(array_get_optional_bool(['a' => 'string'], 'a'));
        assertNull(array_get_optional_bool(['a' => null], 'a'));
        assertNull(array_get_optional_bool(['a' => new stdClass()], 'a'));
        assertNull(array_get_optional_bool(['a' => []], 'a'));
        assertNull(array_get_optional_bool(['a' => fopen(__FILE__, 'rb')], 'a'));
    }

    /**
     * @see array_get_bool()
     */
    public function testArrayGetBool(): void
    {
        assertTrue(array_get_bool([true], 0));
        assertTrue(array_get_bool([1], 0));
        assertTrue(array_get_bool(['YES'], 0));
        assertTrue(array_get_bool(['TRUE'], 0));
        assertTrue(array_get_bool(['1'], 0));
        assertFalse(array_get_bool([false], 0));
        assertFalse(array_get_bool([0], 0));
        assertFalse(array_get_bool(['NO'], 0));
        assertFalse(array_get_bool(['FALSE'], 0));
        assertFalse(array_get_bool(['0'], 0));
        self::assertException(fn() => array_get_bool([150.5], 0), TypeError::class);
        self::assertException(fn() => array_get_bool([150], 0), TypeError::class);
        self::assertException(fn() => array_get_bool(['string'], 0), TypeError::class);
        self::assertException(fn() => array_get_bool([null], 0), TypeError::class);
        self::assertException(fn() => array_get_bool([new stdClass()], 0), TypeError::class);
        self::assertException(fn() => array_get_bool([[]], 0), TypeError::class);
        self::assertException(fn() => array_get_bool([fopen(__FILE__, 'rb')], 0), TypeError::class);
    }

    /**
     * @see array_get_optional_array()
     */
    public function testArrayGetOptionalArray(): void
    {
        assertSame(['a' => 'b'], array_get_optional_array(['a' => ['a' => 'b']], 'a'));
        assertNull(array_get_optional_array(['a' => 150.5], 0));
        assertNull(array_get_optional_array(['a' => 150], 0));
        assertNull(array_get_optional_array(['a' => false], 0));
        assertNull(array_get_optional_array(['a' => 'string'], 0));
        assertNull(array_get_optional_array(['a' => null], 0));
        assertNull(array_get_optional_array(['a' => new stdClass()], 0));
        assertNull(array_get_optional_array(['a' => fopen(__FILE__, 'rb')], 0));
    }

    /**
     * @see array_get_array()
     */
    public function testArrayGetArray(): void
    {
        assertSame(['a' => 'b'], array_get_array([['a' => 'b']], 0));
        self::assertException(fn() => array_get_array([150.5], 0), TypeError::class);
        self::assertException(fn() => array_get_array([150], 0), TypeError::class);
        self::assertException(fn() => array_get_array([false], 0), TypeError::class);
        self::assertException(fn() => array_get_array(['string'], 0), TypeError::class);
        self::assertException(fn() => array_get_array([null], 0), TypeError::class);
        self::assertException(fn() => array_get_array([new stdClass()], 0), TypeError::class);
        self::assertException(fn() => array_get_array([fopen(__FILE__, 'rb')], 0), TypeError::class);
    }

    /**
     * @see array_get_optional_resource()
     */
    public function testArrayGetOptionalResource(): void
    {
        assertIsResource(array_get_optional_resource(['a' => fopen(__FILE__, 'rb')], 'a'));
        assertNull(array_get_optional_resource(['a' => []], 'a'));
        assertNull(array_get_optional_resource(['a' => 150.5], 'a'));
        assertNull(array_get_optional_resource(['a' => 150], 'a'));
        assertNull(array_get_optional_resource(['a' => false], 'a'));
        assertNull(array_get_optional_resource(['a' => 'string'], 'a'));
        assertNull(array_get_optional_resource(['a' => null], 'a'));
        assertNull(array_get_optional_resource(['a' => new stdClass()], 'a'));
    }

    /**
     * @see testArrayGetResource()
     */
    public function testArrayGetResource(): void
    {
        assertIsResource(array_get_resource([fopen(__FILE__, 'rb')], 0));
        self::assertException(fn() => array_get_resource([[]], 0), TypeError::class);
        self::assertException(fn() => array_get_resource([150.5], 0), TypeError::class);
        self::assertException(fn() => array_get_resource([150], 0), TypeError::class);
        self::assertException(fn() => array_get_resource([false], 0), TypeError::class);
        self::assertException(fn() => array_get_resource(['string'], 0), TypeError::class);
        self::assertException(fn() => array_get_resource([null], 0), TypeError::class);
        self::assertException(fn() => array_get_resource([new stdClass()], 0), TypeError::class);
    }

    /**
     * @see array_get_optional_object()
     */
    public function testArrayGetOptionalObject(): void
    {
        assertIsObject(array_get_optional_object(['a' => new stdClass()], 'a'));
        assertNull(array_get_optional_object(['a' => fopen(__FILE__, 'rb')], 'a'));
        assertNull(array_get_optional_object(['a' => []], 'a'));
        assertNull(array_get_optional_object(['a' => 150.5], 'a'));
        assertNull(array_get_optional_object(['a' => 150], 'a'));
        assertNull(array_get_optional_object(['a' => false], 'a'));
        assertNull(array_get_optional_object(['a' => 'string'], 'a'));
        assertNull(array_get_optional_object(['a' => null], 'a'));
    }

    /**
     * @see array_get_object()
     */
    public function testArrayGetObject(): void
    {
        assertIsObject(array_get_object([new stdClass()], 0));
        self::assertException(fn() => array_get_object([fopen(__FILE__, 'rb')], 0), TypeError::class);
        self::assertException(fn() => array_get_object([[]], 0), TypeError::class);
        self::assertException(fn() => array_get_object([150.5], 0), TypeError::class);
        self::assertException(fn() => array_get_object([150], 0), TypeError::class);
        self::assertException(fn() => array_get_object([false], 0), TypeError::class);
        self::assertException(fn() => array_get_object(['string'], 0), TypeError::class);
        self::assertException(fn() => array_get_object([null], 0), TypeError::class);
    }

    /**
     * @see array_get_optional_callable()
     */
    public function testArrayGetOptionalCallable(): void
    {
        assertIsCallable(array_get_optional_callable(['a' => static fn() => 1], 'a'));
        assertNull(array_get_optional_callable(['a' => new stdClass()], 'a'));
        assertNull(array_get_optional_callable(['a' => fopen(__FILE__, 'rb')], 'a'));
        assertNull(array_get_optional_callable(['a' => []], 'a'));
        assertNull(array_get_optional_callable(['a' => 150.5], 'a'));
        assertNull(array_get_optional_callable(['a' => 150], 'a'));
        assertNull(array_get_optional_callable(['a' => false], 'a'));
        assertNull(array_get_optional_callable(['a' => 'string'], 'a'));
        assertNull(array_get_optional_callable(['a' => null], 'a'));
    }

    /**
     * @see array_get_callable()
     */
    public function testArrayGetCallable(): void
    {
        assertIsCallable(array_get_callable([static fn() => 1], 0));
        self::assertException(fn() => array_get_callable([new stdClass()], 0), TypeError::class);
        self::assertException(fn() => array_get_callable([fopen(__FILE__, 'rb')], 0), TypeError::class);
        self::assertException(fn() => array_get_callable([[]], 0), TypeError::class);
        self::assertException(fn() => array_get_callable([150.5], 0), TypeError::class);
        self::assertException(fn() => array_get_callable([150], 0), TypeError::class);
        self::assertException(fn() => array_get_callable([false], 0), TypeError::class);
        self::assertException(fn() => array_get_callable(['string'], 0), TypeError::class);
        self::assertException(fn() => array_get_callable([null], 0), TypeError::class);
    }
}
