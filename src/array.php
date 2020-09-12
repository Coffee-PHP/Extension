<?php

/**
 * array.php
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

if (!function_exists('array_get_int')) {
    /**
     * Attempt to retrieve an integer
     * from the key in the array.
     *
     * @param array $array
     * @param string|int $key
     * @return int
     */
    function array_get_int(array $array, $key): int
    {
        return var_get_int($array[$key] ?? null);
    }
}

if (!function_exists('array_get_string')) {
    /**
     * Attempt to retrieve a string
     * from the key in the array.
     *
     * @param array $array
     * @param string|int $key
     * @return string
     */
    function array_get_string(array $array, $key): string
    {
        return var_get_string($array[$key] ?? null);
    }
}

if (!function_exists('array_get_float')) {
    /**
     * Attempt to retrieve a floating-point
     * number from the key in the array.
     *
     * @param array $array
     * @param string|int $key
     * @return float
     */
    function array_get_float(array $array, $key): float
    {
        return var_get_float($array[$key] ?? null);
    }
}

if (!function_exists('array_get_bool')) {
    /**
     * Attempt to retrieve a boolean
     * from the key in the array.
     *
     * @param array $array
     * @param string|int $key
     * @return bool
     */
    function array_get_bool(array $array, $key): bool
    {
        return var_get_bool($array[$key] ?? null);
    }
}

if (!function_exists('array_get_object')) {
    /**
     * Attempt to retrieve an object
     * from the key in the array.
     *
     * @param array $array
     * @param string|int $key
     * @return object
     */
    function array_get_object(array $array, $key): object
    {
        return var_get_object($array[$key] ?? null);
    }
}

if (!function_exists('array_get_resource')) {
    /**
     * Attempt to retrieve a resource
     * from the key in the array.
     *
     * @param array $array
     * @param string|int $key
     * @return resource
     */
    function array_get_resource(array $array, $key)
    {
        return var_get_resource($array[$key] ?? null);
    }
}

if (!function_exists('array_get_array')) {
    /**
     * Attempt to retrieve an array
     * from the key in the array.
     *
     * @param array $array
     * @param string|int $key
     * @return array
     */
    function array_get_array(array $array, $key): array
    {
        return var_get_array($array[$key] ?? null);
    }
}

if (!function_exists('array_get_callable')) {
    /**
     * Attempt to retrieve a callable
     * from the key in the array.
     *
     * @param array $array
     * @param string|int $key
     * @return callable
     */
    function array_get_callable(array $array, $key): callable
    {
        return var_get_callable($array[$key] ?? null);
    }
}

if (!function_exists('array_get_optional_int')) {
    /**
     * Attempt to retrieve an integer
     * from the key in the array.
     *
     * Return null on failure.
     *
     * @param array $array
     * @param string|int $key
     * @return int|null
     */
    function array_get_optional_int(array $array, $key): ?int
    {
        return var_get_optional_int($array[$key] ?? null);
    }
}

if (!function_exists('array_get_optional_string')) {
    /**
     * Attempt to retrieve a string
     * from the key in the array.
     *
     * Return null on failure.
     *
     * @param array $array
     * @param string|int $key
     * @return string|null
     */
    function array_get_optional_string(array $array, $key): ?string
    {
        return var_get_optional_string($array[$key] ?? null);
    }
}

if (!function_exists('array_get_optional_float')) {
    /**
     * Attempt to retrieve a floating-point
     * number from the key in the array.
     *
     * Return null on failure.
     *
     * @param array $array
     * @param string|int $key
     * @return float|null
     */
    function array_get_optional_float(array $array, $key): ?float
    {
        return var_get_optional_float($array[$key] ?? null);
    }
}


if (!function_exists('array_get_optional_bool')) {
    /**
     * Attempt to retrieve a boolean
     * from the key in the array.
     *
     * Return null on failure.
     *
     * @param array $array
     * @param string|int $key
     * @return bool|null
     */
    function array_get_optional_bool(array $array, $key): ?bool
    {
        return var_get_optional_bool($array[$key] ?? null);
    }
}

if (!function_exists('array_get_optional_object')) {
    /**
     * Attempt to retrieve an object
     * from the key in the array.
     *
     * Return null on failure.
     *
     * @param array $array
     * @param string|int $key
     * @return object|null
     */
    function array_get_optional_object(array $array, $key): ?object
    {
        return var_get_optional_object($array[$key] ?? null);
    }
}

if (!function_exists('array_get_optional_resource')) {
    /**
     * Attempt to retrieve a resource
     * from the key in the array.
     *
     * Return null on failure.
     *
     * @param array $array
     * @param string|int $key
     * @return resource|null
     */
    function array_get_optional_resource(array $array, $key)
    {
        return var_get_optional_resource($array[$key] ?? null);
    }
}

if (!function_exists('array_get_optional_array')) {
    /**
     * Attempt to retrieve an array
     * from the key in the array.
     *
     * Return null on failure.
     *
     * @param array $array
     * @param string|int $key
     * @return array|null
     */
    function array_get_optional_array(array $array, $key): ?array
    {
        return var_get_optional_array($array[$key] ?? null);
    }
}

if (!function_exists('array_get_optional_callable')) {
    /**
     * Attempt to retrieve a callable
     * from the key in the array.
     *
     * Return null on failure.
     *
     * @param array $array
     * @param string|int $key
     * @return callable|null
     */
    function array_get_optional_callable(array $array, $key): ?callable
    {
        return var_get_optional_callable($array[$key] ?? null);
    }
}
