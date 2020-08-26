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

declare (strict_types=1);

namespace CoffeePhp\Extension\Test\Unit;


use BadFunctionCallException;
use PHPUnit\Framework\TestCase;
use Throwable;

use function in_array;
use function mt_getrandmax;
use function mt_rand;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertInstanceOf;
use function PHPUnit\Framework\assertNull;
use function PHPUnit\Framework\assertSame;
use function PHPUnit\Framework\assertTrue;
use function strtoupper;
use function uniqid;
use function var_export;
use function var_get_float;
use function var_get_int;
use function var_get_optional_bool;
use function var_get_optional_float;
use function var_get_optional_int;
use function var_get_optional_string;
use function var_get_string;

use const PHP_FLOAT_MAX;
use const PHP_INT_MAX;

/**
 * Class VarTest
 * @package coffeephp\extension
 * @since 2020-08-11
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class VarTest extends TestCase
{
    public function testString(): void
    {
        $this->performStringTests('');
        $this->performStringTests('1');
        $this->performStringTests('1.0');
        $this->performStringTests('0');
        $this->performStringTests('0.0');
        $this->performStringTests('123123123');
        $this->performStringTests('123123123.123123123');
        $this->performStringTests('TRUE');
        $this->performStringTests('FALSE');
        $this->performStringTests('ON');
        $this->performStringTests('OFF');
        $this->performStringTests('YES');
        $this->performStringTests('NO');
        for ($i = 0; $i < 1000; ++$i) {
            $this->performStringTests(uniqid('', true));
        }
    }

    /**
     * @param string $value
     * @return void
     */
    private function performStringTests(string $value): void
    {
        assertSame($value, var_get_string($value), var_export($value, true));
        assertSame($value, var_get_optional_string($value), var_export($value, true));

        $callables = [];

        if ($value === (string)((int)$value)) {
            assertSame((int)$value, var_get_optional_int($value), var_export($value, true));
        } else {
            assertNull(var_get_optional_int($value), var_export($value, true));
            $callables[] = 'var_get_int';
        }

        if (in_array(strtoupper($value), ['1', 'TRUE', 'YES', 'ON'], true)) {
            assertTrue(var_get_optional_bool($value), var_export($value, true));
        } elseif (in_array(strtoupper($value), ['0', 'FALSE', 'NO', 'OFF'], true)) {
            assertFalse(var_get_optional_bool($value), var_export($value, true));
        } else {
            assertNull(var_get_optional_bool($value), var_export($value, true));
            $callables[] = 'var_get_bool';
        }

        if (is_numeric($value)) {
            assertSame((float)$value, var_get_optional_float($value), var_export($value, true));
        } else {
            assertNull(var_get_optional_float($value), var_export($value, true));
            $callables[] = 'var_get_float';
        }


        $this->performExceptionTests(
            BadFunctionCallException::class,
            $value,
            ...$callables
        );
    }

    public function testInt(): void
    {
        $this->performIntTests(PHP_INT_MIN);
        $this->performIntTests(0);
        $this->performIntTests(1);
        $this->performIntTests(PHP_INT_MAX);
        for ($i = 0; $i < 1000; ++$i) {
            $this->performIntTests(mt_rand());
        }
    }

    /**
     * @param int $value
     */
    private function performIntTests(int $value): void
    {
        assertSame((string)$value, var_get_string($value), var_export($value, true));
        assertSame((string)$value, var_get_optional_string($value), var_export($value, true));
        assertSame($value, var_get_int($value), var_export($value, true));
        assertSame($value, var_get_optional_int($value), var_export($value, true));
        assertSame((float)$value, var_get_float($value), var_export($value, true));
        assertSame((float)$value, var_get_optional_float($value), var_export($value, true));

        if ($value === 1) {
            assertTrue(var_get_optional_bool($value), var_export($value, true));
        } elseif ($value === 0) {
            assertFalse(var_get_optional_bool($value), var_export($value, true));
        } else {
            assertNull(var_get_optional_bool($value), var_export($value, true));
            $this->performExceptionTests(
                BadFunctionCallException::class,
                $value,
                'var_get_bool'
            );
        }
    }

    public function testFloat(): void
    {
        $this->performFloatTests(PHP_FLOAT_MIN);
        $this->performFloatTests(0.0);
        $this->performFloatTests(1.0);
        $this->performFloatTests(746919802.0000025);
        $this->performFloatTests(PHP_FLOAT_MAX);
        for ($i = 0; $i < 1000; ++$i) {
            $this->performFloatTests((mt_rand() / mt_getrandmax()) * mt_rand());
        }
    }

    /**
     * @param float $value
     */
    private function performFloatTests(float $value): void
    {
        assertSame((string)$value, var_get_string($value), var_export($value, true));
        assertSame((string)$value, var_get_optional_string($value), var_export($value, true));
        assertSame($value, var_get_float($value), var_export($value, true));
        assertSame($value, var_get_optional_float($value), var_export($value, true));

        $callables = [];

        if ($value == (int)$value) {
            assertSame((int)$value, var_get_optional_int($value), var_export($value, true));
        } else {
            assertNull(var_get_optional_int($value), var_export($value, true));
            $callables[] = 'var_get_int';
        }

        if ($value === 1.0) {
            assertTrue(var_get_optional_bool($value), var_export($value, true));
        } elseif ($value === 0.0) {
            assertFalse(var_get_optional_bool($value), var_export($value, true));
        } else {
            assertNull(var_get_optional_bool($value), var_export($value, true));
            $callables[] = 'var_get_bool';
        }

        $this->performExceptionTests(
            BadFunctionCallException::class,
            $value,
            ...$callables
        );
    }

    public function testPositiveBool(): void
    {
        assertSame('1', var_get_string(true));
        assertSame('1', var_get_optional_string(true));
        assertTrue(var_get_bool(true));
        assertTrue(var_get_optional_bool(true));
        assertSame(1, var_get_int(true));
        assertSame(1, var_get_optional_int(true));
        assertSame(1.0, var_get_float(true));
        assertSame(1.0, var_get_optional_float(true));
    }

    public function testNegativeBool(): void
    {
        assertSame('0', var_get_string(false));
        assertSame('0', var_get_optional_string(false));
        assertFalse(var_get_bool(false));
        assertFalse(var_get_optional_bool(false));
        assertSame(0, var_get_int(false));
        assertSame(0, var_get_optional_int(false));
        assertSame(0.0, var_get_float(false));
        assertSame(0.0, var_get_optional_float(false));
    }

    public function testNull(): void
    {
        assertNull(var_get_optional_float(null));
        assertNull(var_get_optional_int(null));
        assertNull(var_get_optional_bool(null));
        assertNull(var_get_optional_string(null));

        $this->performExceptionTests(
            BadFunctionCallException::class,
            null,
            'var_get_float',
            'var_get_int',
            'var_get_bool',
            'var_get_string'
        );
    }

    /**
     * @param string $exceptionClass
     * @param mixed $value
     * @param callable ...$callables
     */
    private function performExceptionTests(string $exceptionClass, $value, callable ...$callables): void
    {
        foreach ($callables as $callable) {
            try {
                $callable($value);
                assertTrue(false, $callable[1]);
            } catch (Throwable $e) {
                assertInstanceOf($exceptionClass, $e, $e->getMessage());
            }
        }
    }
}
