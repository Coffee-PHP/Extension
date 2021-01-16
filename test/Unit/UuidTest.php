<?php

/**
 * UuidTest.php
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

use function PHPUnit\Framework\assertNotSame;
use function PHPUnit\Framework\assertTrue;
use function uuid_generate_random;
use function uuid_is_valid;

/**
 * Class UuidTest
 * @package coffeephp\extension
 * @since 2021-01-12
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class UuidTest extends TestCase
{
    /**
     * @throws Exception
     * @see uuid_generate_random()
     */
    public function testUuidGenerateRandom(): void
    {
        $current = uuid_generate_random();
        for ($i = 0; $i < 100; ++$i) {
            assertTrue(uuid_is_valid($current));
            $next = uuid_generate_random();
            assertNotSame($current, $next);
            $current = $next;
        }
    }
}
