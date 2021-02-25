<?php

/**
 * TimeTest.php
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
 * @since 2021-02-26
 */

declare(strict_types=1);

namespace CoffeePhp\Extension\Test\Unit;

use CoffeePhp\QualityTools\TestCase;

use function abs;
use function PHPUnit\Framework\assertLessThanOrEqual;
use function time;
use function time_millis;

/**
 * Class TimeTest
 * @package coffeephp\extension
 * @since 2021-02-26
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class TimeTest extends TestCase
{
    /**
     * @see time_millis()
     */
    public function testTimeMillis(): void
    {
        assertLessThanOrEqual(
            2,
            abs(time_millis() / 1000 - time())
        );
    }
}
