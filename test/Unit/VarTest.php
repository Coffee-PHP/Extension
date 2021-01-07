<?php

/**
 * VarTest.php
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

namespace CoffeePhp\Extension\Test\Unit;

use CoffeePhp\QualityTools\TestCase;
use stdClass;
use TypeError;

use function fopen;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertIsCallable;
use function PHPUnit\Framework\assertIsObject;
use function PHPUnit\Framework\assertIsResource;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;
use function var_get_array;
use function var_get_bool;
use function var_get_callable;
use function var_get_float;
use function var_get_int;
use function var_get_object;
use function var_get_optional_array;
use function var_get_optional_bool;
use function var_get_optional_callable;
use function var_get_optional_float;
use function var_get_optional_int;
use function var_get_optional_object;
use function var_get_optional_resource;
use function var_get_optional_string;
use function var_get_resource;
use function var_get_string;

/**
 * Class VarTest
 * @package coffeephp\extension
 * @since 2020-08-11
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class VarTest extends TestCase
{
    /**
     * @see var_get_optional_string()
     */
    public function testVarGetOptionalString(): void
    {
        assertSame('string', var_get_optional_string('string'));
        assertNull(var_get_optional_string(null));
        assertNull(var_get_optional_string(2));
        assertNull(var_get_optional_string(8.52));
        assertNull(var_get_optional_string(new stdClass()));
        assertNull(var_get_optional_string([]));
        assertNull(var_get_optional_string(fopen(__FILE__, 'rb')));
        assertNull(var_get_optional_string(false));
    }

    /**
     * @see var_get_string()
     */
    public function testVarGetString(): void
    {
        assertSame('string', var_get_string('string'));
        self::assertException(fn() => var_get_string(null), TypeError::class);
        self::assertException(fn() => var_get_string(2), TypeError::class);
        self::assertException(fn() => var_get_string(8.52), TypeError::class);
        self::assertException(fn() => var_get_string(new stdClass()), TypeError::class);
        self::assertException(fn() => var_get_string([]), TypeError::class);
        self::assertException(fn() => var_get_string(fopen(__FILE__, 'rb')), TypeError::class);
        self::assertException(fn() => var_get_string(false), TypeError::class);
    }

    /**
     * @see var_get_optional_int()
     */
    public function testVarGetOptionalInt(): void
    {
        assertSame(150, var_get_optional_int(150));
        assertNull(var_get_optional_int(150.5));
        assertNull(var_get_optional_int(false));
        assertNull(var_get_optional_int('string'));
        assertNull(var_get_optional_int(null));
        assertNull(var_get_optional_int(new stdClass()));
        assertNull(var_get_optional_int([]));
        assertNull(var_get_optional_int(fopen(__FILE__, 'rb')));
    }

    /**
     * @see var_get_int()
     */
    public function testVarGetInt(): void
    {
        assertSame(150, var_get_int(150));
        self::assertException(fn() => var_get_int(150.5), TypeError::class);
        self::assertException(fn() => var_get_int(false), TypeError::class);
        self::assertException(fn() => var_get_int('string'), TypeError::class);
        self::assertException(fn() => var_get_int(null), TypeError::class);
        self::assertException(fn() => var_get_int(new stdClass()), TypeError::class);
        self::assertException(fn() => var_get_int([]), TypeError::class);
        self::assertException(fn() => var_get_int(fopen(__FILE__, 'rb')), TypeError::class);
    }

    /**
     * @see var_get_optional_float()
     */
    public function testVarGetOptionalFloat(): void
    {
        assertSame(150.5, var_get_optional_float(150.5));
        assertSame(150.0, var_get_optional_float(150));
        assertNull(var_get_optional_float(false));
        assertNull(var_get_optional_float('string'));
        assertNull(var_get_optional_float(null));
        assertNull(var_get_optional_float(new stdClass()));
        assertNull(var_get_optional_float([]));
        assertNull(var_get_optional_float(fopen(__FILE__, 'rb')));
    }

    /**
     * @see var_get_float()
     */
    public function testVarGetFloat(): void
    {
        assertSame(150.5, var_get_float(150.5));
        assertSame(150.0, var_get_float(150));
        self::assertException(fn() => var_get_float(false), TypeError::class);
        self::assertException(fn() => var_get_float('string'), TypeError::class);
        self::assertException(fn() => var_get_float(null), TypeError::class);
        self::assertException(fn() => var_get_float(new stdClass()), TypeError::class);
        self::assertException(fn() => var_get_float([]), TypeError::class);
        self::assertException(fn() => var_get_float(fopen(__FILE__, 'rb')), TypeError::class);
    }

    /**
     * @see var_get_optional_bool()
     */
    public function testVarGetOptionalBool(): void
    {
        assertTrue(var_get_optional_bool(true));
        assertTrue(var_get_optional_bool(1));
        assertTrue(var_get_optional_bool('YES'));
        assertTrue(var_get_optional_bool('TRUE'));
        assertTrue(var_get_optional_bool('1'));
        assertFalse(var_get_optional_bool(false));
        assertFalse(var_get_optional_bool(0));
        assertFalse(var_get_optional_bool('NO'));
        assertFalse(var_get_optional_bool('FALSE'));
        assertFalse(var_get_optional_bool('0'));
        assertNull(var_get_optional_bool(150.5));
        assertNull(var_get_optional_bool(150));
        assertNull(var_get_optional_bool('string'));
        assertNull(var_get_optional_bool(null));
        assertNull(var_get_optional_bool(new stdClass()));
        assertNull(var_get_optional_bool([]));
        assertNull(var_get_optional_bool(fopen(__FILE__, 'rb')));
    }

    /**
     * @see var_get_bool()
     */
    public function testVarGetBool(): void
    {
        assertTrue(var_get_bool(true));
        assertTrue(var_get_bool(1));
        assertTrue(var_get_bool('YES'));
        assertTrue(var_get_bool('TRUE'));
        assertTrue(var_get_bool('1'));
        assertFalse(var_get_bool(false));
        assertFalse(var_get_bool(0));
        assertFalse(var_get_bool('NO'));
        assertFalse(var_get_bool('FALSE'));
        assertFalse(var_get_bool('0'));
        self::assertException(fn() => var_get_bool(150.5), TypeError::class);
        self::assertException(fn() => var_get_bool(150), TypeError::class);
        self::assertException(fn() => var_get_bool('string'), TypeError::class);
        self::assertException(fn() => var_get_bool(null), TypeError::class);
        self::assertException(fn() => var_get_bool(new stdClass()), TypeError::class);
        self::assertException(fn() => var_get_bool([]), TypeError::class);
        self::assertException(fn() => var_get_bool(fopen(__FILE__, 'rb')), TypeError::class);
    }

    /**
     * @see var_get_optional_array()
     */
    public function testVarGetOptionalArray(): void
    {
        assertSame(['a' => 'b'], var_get_optional_array(['a' => 'b']));
        assertSame([], var_get_optional_array([]));
        assertNull(var_get_optional_array(150.5));
        assertNull(var_get_optional_array(150));
        assertNull(var_get_optional_array(false));
        assertNull(var_get_optional_array('string'));
        assertNull(var_get_optional_array(null));
        assertNull(var_get_optional_array(new stdClass()));
        assertNull(var_get_optional_array(fopen(__FILE__, 'rb')));
    }

    /**
     * @see var_get_array()
     */
    public function testVarGetArray(): void
    {
        assertSame(['a' => 'b'], var_get_array(['a' => 'b']));
        assertSame([], var_get_array([]));
        self::assertException(fn() => var_get_array(150.5), TypeError::class);
        self::assertException(fn() => var_get_array(150), TypeError::class);
        self::assertException(fn() => var_get_array(false), TypeError::class);
        self::assertException(fn() => var_get_array('string'), TypeError::class);
        self::assertException(fn() => var_get_array(null), TypeError::class);
        self::assertException(fn() => var_get_array(new stdClass()), TypeError::class);
        self::assertException(fn() => var_get_array(fopen(__FILE__, 'rb')), TypeError::class);
    }

    /**
     * @see var_get_optional_resource()
     */
    public function testVarGetOptionalResource(): void
    {
        assertIsResource(var_get_optional_resource(fopen(__FILE__, 'rb')));
        assertNull(var_get_optional_resource([]));
        assertNull(var_get_optional_resource(150.5));
        assertNull(var_get_optional_resource(150));
        assertNull(var_get_optional_resource(false));
        assertNull(var_get_optional_resource('string'));
        assertNull(var_get_optional_resource(null));
        assertNull(var_get_optional_resource(new stdClass()));
    }

    /**
     * @see var_get_resource()
     */
    public function testVarGetResource(): void
    {
        assertIsResource(var_get_resource(fopen(__FILE__, 'rb')));
        self::assertException(fn() => var_get_resource([]), TypeError::class);
        self::assertException(fn() => var_get_resource(150.5), TypeError::class);
        self::assertException(fn() => var_get_resource(150), TypeError::class);
        self::assertException(fn() => var_get_resource(false), TypeError::class);
        self::assertException(fn() => var_get_resource('string'), TypeError::class);
        self::assertException(fn() => var_get_resource(null), TypeError::class);
        self::assertException(fn() => var_get_resource(new stdClass()), TypeError::class);
    }

    /**
     * @see var_get_optional_object()
     */
    public function testVarGetOptionalObject(): void
    {
        assertIsObject(var_get_optional_object(new stdClass()));
        assertNull(var_get_optional_object(fopen(__FILE__, 'rb')));
        assertNull(var_get_optional_object([]));
        assertNull(var_get_optional_object(150.5));
        assertNull(var_get_optional_object(150));
        assertNull(var_get_optional_object(false));
        assertNull(var_get_optional_object('string'));
        assertNull(var_get_optional_object(null));
    }

    /**
     * @see var_get_object()
     */
    public function testVarGetObject(): void
    {
        assertIsObject(var_get_object(new stdClass()));
        self::assertException(fn() => var_get_object(fopen(__FILE__, 'rb')), TypeError::class);
        self::assertException(fn() => var_get_object([]), TypeError::class);
        self::assertException(fn() => var_get_object(150.5), TypeError::class);
        self::assertException(fn() => var_get_object(150), TypeError::class);
        self::assertException(fn() => var_get_object(false), TypeError::class);
        self::assertException(fn() => var_get_object('string'), TypeError::class);
        self::assertException(fn() => var_get_object(null), TypeError::class);
    }

    /**
     * @see var_get_optional_callable()
     */
    public function testVarGetOptionalCallable(): void
    {
        assertIsCallable(var_get_optional_callable(static fn() => 1));
        assertNull(var_get_optional_callable(new stdClass()));
        assertNull(var_get_optional_callable(fopen(__FILE__, 'rb')));
        assertNull(var_get_optional_callable([]));
        assertNull(var_get_optional_callable(150.5));
        assertNull(var_get_optional_callable(150));
        assertNull(var_get_optional_callable(false));
        assertNull(var_get_optional_callable('string'));
        assertNull(var_get_optional_callable(null));
    }

    /**
     * @see var_get_callable()
     */
    public function testVarGetCallable(): void
    {
        assertIsCallable(var_get_callable(static fn() => 1));
        self::assertException(fn() => var_get_callable(new stdClass()), TypeError::class);
        self::assertException(fn() => var_get_callable(fopen(__FILE__, 'rb')), TypeError::class);
        self::assertException(fn() => var_get_callable([]), TypeError::class);
        self::assertException(fn() => var_get_callable(150.5), TypeError::class);
        self::assertException(fn() => var_get_callable(150), TypeError::class);
        self::assertException(fn() => var_get_callable(false), TypeError::class);
        self::assertException(fn() => var_get_callable('string'), TypeError::class);
        self::assertException(fn() => var_get_callable(null), TypeError::class);
    }
}
