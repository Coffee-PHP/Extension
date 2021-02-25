<?php

/**
 * validation.php
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
 * @since 2021-01-08
 */

declare(strict_types=1);

/**
 * Validate the given e-mail address.
 *
 * @param string $email
 * @return bool
 */
function email_is_valid(string $email): bool
{
    $sanitizedEmail = (string)filter_var($email, FILTER_SANITIZE_EMAIL);
    return $sanitizedEmail === $email &&
        filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate the given unicode e-mail address.
 *
 * @param string $unicodeEmail
 * @return bool
 */
function unicode_email_is_valid(string $unicodeEmail): bool
{
    $sanitizedEmail = (string)filter_var($unicodeEmail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_EMAIL_UNICODE);
    return $sanitizedEmail === $unicodeEmail &&
        filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate the given URL.
 *
 * @param string $url
 * @return bool
 */
function url_is_valid(string $url): bool
{
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

/**
 * Validate the given domain.
 *
 * @param string $domain
 * @return bool
 */
function domain_is_valid(string $domain): bool
{
    return filter_var($domain, FILTER_VALIDATE_DOMAIN) !== false;
}

/**
 * Validate the given IP address.
 *
 * @param string $ip
 * @return bool
 */
function ip_is_valid(string $ip): bool
{
    return filter_var($ip, FILTER_VALIDATE_IP) !== false;
}

/**
 * Validate the given IPv4 address.
 *
 * @param string $ipV4
 * @return bool
 */
function ipv4_is_valid(string $ipV4): bool
{
    return filter_var($ipV4, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
}


/**
 * Validate the given IPv6 address.
 *
 * @param string $ipV6
 * @return bool
 */
function ipv6_is_valid(string $ipV6): bool
{
    return filter_var($ipV6, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
}

/**
 * Validate the given MAC address.
 *
 * @param string $mac
 * @return bool
 */
function mac_is_valid(string $mac): bool
{
    return filter_var($mac, FILTER_VALIDATE_MAC) !== false;
}

/**
 * Validate the given hostname.
 *
 * @param string $hostname
 * @return bool
 */
function hostname_is_valid(string $hostname): bool
{
    return filter_var($hostname, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) !== false;
}
