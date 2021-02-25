<?php

/**
 * MbstringTest.php
 *
 * Copyright 2021 Danny Damsky
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
 * @since 2021-02-25
 */

declare(strict_types=1);

namespace CoffeePhp\Extension\Test\Unit;

use CoffeePhp\QualityTools\TestCase;

use function mb_str_contains;
use function mb_str_icontains;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

/**
 * Class MbstringTest
 * @package coffeephp\extension
 * @since 2021-02-25
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class MbstringTest extends TestCase
{
    /**
     * @see mb_str_contains()
     */
    public function testMbStrContains(): void
    {
        assertTrue(mb_str_contains('abc', 'b'));
        assertTrue(mb_str_contains('abc', 'b'));
        assertTrue(mb_str_contains('abc', ''));
        assertFalse(mb_str_contains('abc', 'd'));
        assertFalse(mb_str_contains('abc', 'B'));
    }

    /**
     * @see mb_str_icontains()
     */
    public function testMbStrIContains(): void
    {
        assertTrue(mb_str_icontains('abc', 'B'));
        assertTrue(mb_str_icontains('abc', 'B', encoding: 'UTF8'));
        assertTrue(mb_str_icontains('abc', 'b'));
        assertTrue(mb_str_icontains('abc', ''));
        assertFalse(mb_str_icontains('abc', 'D'));
    }
}
