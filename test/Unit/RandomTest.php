<?php

/**
 * RandomTest.php
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
 * @since 2021-01-12
 */

declare(strict_types=1);

namespace CoffeePhp\Extension\Test\Unit;

use CoffeePhp\QualityTools\TestCase;
use Exception;

use function PHPUnit\Framework\assertGreaterThanOrEqual;
use function PHPUnit\Framework\assertLessThan;
use function PHPUnit\Framework\assertNotSame;
use function PHPUnit\Framework\assertSame;
use function random_bool;
use function random_float;
use function random_int;
use function random_string;
use function strlen;

/**
 * Class RandomTest
 * @package coffeephp\extension
 * @since 2021-01-12
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class RandomTest extends TestCase
{
    /**
     * @throws Exception
     * @see random_bool()
     */
    public function testRandomBool(): void
    {
        $bool = random_bool();
        $consecutiveDiff = 0;
        for ($i = 0; $i < 100; ++$i) {
            $next = random_bool();
            $consecutiveDiff += ($bool === $next) ? 0 : 1;
            $bool = $next;
        }
        // At least 40% of booleans were different from each other.
        assertGreaterThanOrEqual(40, $consecutiveDiff);
    }

    /**
     * @throws Exception
     * @see random_float()
     */
    public function testRandomFloat(): void
    {
        $float = random_float();
        for ($i = 0; $i < 100; ++$i) {
            assertGreaterThanOrEqual(0, $float);
            assertLessThan(1, $float);
            $next = random_float();
            assertNotSame($float, $next);
            $float = $next;
        }
    }

    /**
     * @throws Exception
     * @see random_string()
     */
    public function testRandomString(): void
    {
        $randomStringLength = random_int(0, 256) + 10;
        $string = random_string($randomStringLength);
        for ($i = 0; $i < 100; ++$i) {
            assertSame($randomStringLength, strlen($string));
            $next = random_string($randomStringLength);
            assertNotSame($string, $next);
            $string = $next;
        }
    }
}
