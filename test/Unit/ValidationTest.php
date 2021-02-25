<?php

/**
 * ValidationTest.php
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

use function domain_is_valid;
use function email_is_valid;
use function hostname_is_valid;
use function ip_is_valid;
use function ipv4_is_valid;
use function ipv6_is_valid;
use function mac_is_valid;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;
use function regexp_is_valid;
use function unicode_email_is_valid;
use function url_is_valid;

/**
 * Class ValidationTest
 * @package coffeephp\extension
 * @since 2021-01-12
 * @author Danny Damsky <dannydamsky99@gmail.com>
 */
final class ValidationTest extends TestCase
{
    /**
     * @see email_is_valid()
     * @see unicode_email_is_valid()
     */
    public function testEmailIsValid(): void
    {
        for ($i = 0; $i < 50; ++$i) {
            $email = $this->getFaker()->email;
            assertTrue(email_is_valid($email));
            assertTrue(unicode_email_is_valid($email));
        }
        assertFalse(email_is_valid('a@email'));
        assertFalse(email_is_valid('user@ex~ample.com'));
    }

    /**
     * @see url_is_valid()
     */
    public function testUrlIsValid(): void
    {
        for ($i = 0; $i < 50; ++$i) {
            assertTrue(url_is_valid($this->getFaker()->url));
        }
        assertFalse(url_is_valid('http:/www.example.com'));
        assertFalse(url_is_valid('http:://www.example.com'));
        assertFalse(url_is_valid('https://www.exa~mple.com'));
    }

    /**
     * @see domain_is_valid()
     */
    public function testDomainIsValid(): void
    {
        for ($i = 0; $i < 50; ++$i) {
            assertTrue(domain_is_valid($this->getFaker()->domainName));
        }
    }

    /**
     * @see ip_is_valid()
     */
    public function testIpIsValid(): void
    {
        for ($i = 0; $i < 50; ++$i) {
            assertTrue(ip_is_valid($this->getFaker()->ipv4));
            assertTrue(ip_is_valid($this->getFaker()->ipv6));
        }
        assertFalse(ip_is_valid('255.255.255.255.0'));
    }

    /**
     * @see ipv4_is_valid()
     */
    public function testIpv4IsValid(): void
    {
        for ($i = 0; $i < 50; ++$i) {
            assertTrue(ipv4_is_valid($this->getFaker()->ipv4));
            assertFalse(ipv4_is_valid($this->getFaker()->ipv6));
        }
        assertFalse(ipv4_is_valid('255.255.255.255.0'));
    }

    /**
     * @see ipv6_is_valid()
     */
    public function testIpv6IsValid(): void
    {
        for ($i = 0; $i < 50; ++$i) {
            assertFalse(ipv6_is_valid($this->getFaker()->ipv4));
            assertTrue(ipv6_is_valid($this->getFaker()->ipv6));
        }
        assertFalse(ipv6_is_valid('255.255.255.255.0'));
    }

    /**
     * @see mac_is_valid()
     */
    public function testMacIsValid(): void
    {
        for ($i = 0; $i < 50; ++$i) {
            assertTrue(mac_is_valid($this->getFaker()->macAddress));
        }
        assertFalse(mac_is_valid('41:35:DA:E8:CG:B2'));
    }

    /**
     * @see hostname_is_valid()
     */
    public function testValidateHostname(): void
    {
        for ($i = 0; $i < 50; ++$i) {
            assertTrue(hostname_is_valid($this->getFaker()->domainName));
        }
        assertFalse(hostname_is_valid('exa~mple.com'));
    }
}
