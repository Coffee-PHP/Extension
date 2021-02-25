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

declare(strict_types=1);

/**
 * Attempt to retrieve an integer
 * from the key in the array.
 *
 * @param array $array
 * @param string|int $key
 * @return int
 */
function array_get_int(array $array, string|int $key): int
{
    if (array_key_exists($key, $array)) {
        $value = $array[$key];
        return filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)
            ?? throw new TypeError(
                'array_get_int(): Argument #1 ($array) at the offset of argument #2 ($key) is expected' .
                'to return int, ' . get_debug_type($value) . ' returned'
            );
    }
    throw new TypeError('array_get_int(): Argument #1 ($array) does not contain the offset of argument #2 ($key)');
}

/**
 * Attempt to retrieve a string
 * from the key in the array.
 *
 * @param array $array
 * @param string|int $key
 * @return string
 */
function array_get_string(array $array, string|int $key): string
{
    if (array_key_exists($key, $array)){
        $value = $array[$key];
        if (is_string($value)) {
            return $value;
        }
        throw new TypeError(
            'array_get_string(): Argument #1 ($array) at the offset of argument #2 ($key) is expected' .
            'to return string, ' . get_debug_type($value) . ' returned'
        );
    }
    throw new TypeError('array_get_string(): Argument #1 ($array) does not contain the offset of argument #2 ($key)');
}

/**
 * Attempt to retrieve a floating-point
 * number from the key in the array.
 *
 * @param array $array
 * @param string|int $key
 * @return float
 */
function array_get_float(array $array, string|int $key): float
{
    if (array_key_exists($key, $array)) {
        $value = $array[$key];
        return filter_var($value, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE)
            ?? throw new TypeError(
                'array_get_float(): Argument #1 ($array) at the offset of argument #2 ($key) is expected' .
                'to return float, ' . get_debug_type($value) . ' returned'
            );
    }
    throw new TypeError('array_get_float(): Argument #1 ($array) does not contain the offset of argument #2 ($key)');
}

/**
 * Attempt to retrieve a boolean
 * from the key in the array.
 *
 * @param array $array
 * @param string|int $key
 * @return bool
 */
function array_get_bool(array $array, string|int $key): bool
{
    if (array_key_exists($key, $array)) {
        $value = $array[$key];
        if ($value === null) {
            throw new TypeError(
                'array_get_bool(): Argument #1 ($array) at the offset of argument #2 ($key) is expected' .
                'to return bool, null returned'
            );
        }
        return filter_var($value, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)
            ?? throw new TypeError(
                'array_get_bool(): Argument #1 ($array) at the offset of argument #2 ($key) is expected' .
                'to return bool, ' . get_debug_type($value) . ' returned'
            );
    }
    throw new TypeError('array_get_bool(): Argument #1 ($array) does not contain the offset of argument #2 ($key)');
}

/**
 * Attempt to retrieve an object
 * from the key in the array.
 *
 * @param array $array
 * @param string|int $key
 * @return object
 */
function array_get_object(array $array, string|int $key): object
{
    if (array_key_exists($key, $array)) {
        $value = $array[$key];
        if (is_object($value)) {
            return $value;
        }
        throw new TypeError(
            'array_get_object(): Argument #1 ($array) at the offset of argument #2 ($key) is expected' .
            'to return object, ' . get_debug_type($value) . ' returned'
        );
    }
    throw new TypeError('array_get_object(): Argument #1 ($array) does not contain the offset of argument #2 ($key)');
}

/**
 * Attempt to retrieve a resource
 * from the key in the array.
 *
 * @param array $array
 * @param string|int $key
 * @return resource
 */
function array_get_resource(array $array, string|int $key)
{
    if (array_key_exists($key, $array)) {
        $value = $array[$key];
        if (is_resource($value)) {
            return $value;
        }
        throw new TypeError(
            'array_get_resource(): Argument #1 ($array) at the offset of argument #2 ($key) is expected' .
            'to return resource, ' . get_debug_type($value) . ' returned'
        );
    }
    throw new TypeError('array_get_resource(): Argument #1 ($array) does not contain the offset of argument #2 ($key)');
}

/**
 * Attempt to retrieve an array
 * from the key in the array.
 *
 * @param array $array
 * @param string|int $key
 * @return array
 */
function array_get_array(array $array, string|int $key): array
{
    if (array_key_exists($key, $array)) {
        $value = $array[$key];
        if (is_array($value)) {
            return $value;
        }
        throw new TypeError(
            'array_get_array(): Argument #1 ($array) at the offset of argument #2 ($key) is expected' .
            'to return array, ' . get_debug_type($value) . ' returned'
        );
    }
    throw new TypeError('array_get_array(): Argument #1 ($array) does not contain the offset of argument #2 ($key)');
}

/**
 * Attempt to retrieve a callable
 * from the key in the array.
 *
 * @param array $array
 * @param string|int $key
 * @return callable
 */
function array_get_callable(array $array, string|int $key): callable
{
    if (array_key_exists($key, $array)) {
        $value = $array[$key];
        if (is_callable($value)) {
            return $value;
        }
        throw new TypeError(
            'array_get_callable(): Argument #1 ($array) at the offset of argument #2 ($key) is expected' .
            'to return callable, ' . get_debug_type($value) . ' returned'
        );
    }
    throw new TypeError('array_get_callable(): Argument #1 ($array) does not contain the offset of argument #2 ($key)');
}

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
function array_get_optional_int(array $array, string|int $key): ?int
{
    if (isset($array[$key])) {
        return filter_var($array[$key], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
    }
    return null;
}

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
function array_get_optional_string(array $array, string|int $key): ?string
{
    if (isset($array[$key])) {
        $value = $array[$key];
        if (is_string($value)) {
            return $value;
        }
    }
    return null;
}

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
function array_get_optional_float(array $array, string|int $key): ?float
{
    if (isset($array[$key])) {
        return filter_var($array[$key], FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
    }
    return null;
}


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
function array_get_optional_bool(array $array, string|int $key): ?bool
{
    if (isset($array[$key])) {
        return filter_var($array[$key], FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
    }
    return null;
}

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
function array_get_optional_object(array $array, string|int $key): ?object
{
    if (isset($array[$key])) {
        $value = $array[$key];
        if (is_object($value)) {
            return $value;
        }
    }
    return null;
}

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
function array_get_optional_resource(array $array, string|int $key)
{
    if (isset($array[$key])) {
        $value = $array[$key];
        if (is_resource($value)) {
            return $value;
        }
    }
    return null;
}

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
function array_get_optional_array(array $array, string|int $key): ?array
{
    if (isset($array[$key])) {
        $value = $array[$key];
        if (is_array($value)) {
            return $value;
        }
    }
    return null;
}

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
function array_get_optional_callable(array $array, string|int $key): ?callable
{
    if (isset($array[$key])) {
        $value = $array[$key];
        if (is_callable($value)) {
            return $value;
        }
    }
    return null;
}
