<?php

/**
 * var.php
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
 * Cast the mixed value to an
 * integer and return it.
 *
 * @param mixed $var
 * @return int
 */
function var_get_int(mixed $var): int
{
    return filter_var($var, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)
        ?? throw new TypeError(
            'var_get_int(): Argument #1 ($var) must be of type int, ' . get_debug_type($var) . ' given'
        );
}

/**
 * Get a string from the given value.
 *
 * @param mixed $var
 * @return string
 */
function var_get_string(mixed $var): string
{
    return is_string($var)
        ? $var
        : throw new TypeError(
            'var_get_string(): Argument #1 ($var) must be of type string, ' . get_debug_type($var) . ' given'
        );
}

/**
 * Get a floating point from the given value.
 *
 * @param mixed $var
 * @return float
 */
function var_get_float(mixed $var): float
{
    return filter_var($var, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE)
        ?? throw new TypeError(
            'var_get_float(): Argument #1 ($var) must be of type float, ' . get_debug_type($var) . ' given'
        );
}

/**
 * Get a boolean from the given value.
 *
 * @param mixed $var
 * @return bool
 */
function var_get_bool(mixed $var): bool
{
    if ($var === null) {
        throw new TypeError('var_get_bool(): Argument #1 ($var) must be of type bool, null given');
    }
    return filter_var($var, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
        ?? throw new TypeError(
            'var_get_bool(): Argument #1 ($var) must be of type bool, ' . get_debug_type($var) . ' given'
        );
}

/**
 * Get an object from the given value.
 *
 * @param mixed $var
 * @return object
 */
function var_get_object(mixed $var): object
{
    return is_object($var)
        ? $var
        : throw new TypeError(
            'var_get_object(): Argument #1 ($var) must be of type object, ' . get_debug_type($var) . ' given'
        );
}

/**
 * Get a resource from the given value.
 *
 * @param mixed $var
 * @return resource
 */
function var_get_resource(mixed $var)
{
    return is_resource($var)
        ? $var
        : throw new TypeError(
            'var_get_resource(): Argument #1 ($var) must be of type resource, ' . get_debug_type($var) . ' given'
        );
}

/**
 * Get an array from the given value.
 *
 * @param mixed $var
 * @return array
 */
function var_get_array(mixed $var): array
{
    return is_array($var)
        ? $var
        : throw new TypeError(
            'var_get_array(): Argument #1 ($var) must be of type array, ' . get_debug_type($var) . ' given'
        );
}

/**
 * Get a callable from the given value.
 *
 * @param mixed $var
 * @return callable
 */
function var_get_callable(mixed $var): callable
{
    return is_callable($var)
        ? $var
        : throw new TypeError(
            'var_get_callable(): Argument #1 ($var) must be of type callable, ' . get_debug_type($var) . ' given'
        );
}

/**
 * Attempt to retrieve an integer from the given value,
 * return null on failure.
 *
 * @param mixed $var
 * @return int|null
 */
function var_get_optional_int(mixed $var): ?int
{
    return filter_var($var, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
}

/**
 * Attempt to retrieve a string from the given value,
 * return null on failure.
 *
 * @param mixed $var
 * @return string|null
 */
function var_get_optional_string(mixed $var): ?string
{
    return is_string($var) ? $var : null;
}

/**
 * Attempt to retrieve a float from the given value,
 * return null on failure.
 *
 * @param mixed $var
 * @return float|null
 */
function var_get_optional_float(mixed $var): ?float
{
    return filter_var($var, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
}

/**
 * Attempt to retrieve a boolean from the given value,
 * return null on failure.
 *
 * @param mixed $var
 * @return bool|null
 */
function var_get_optional_bool(mixed $var): ?bool
{
    return $var === null ? null : filter_var($var, FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE);
}

/**
 * Attempt to retrieve an object from the given value,
 * return null on failure.
 *
 * @param mixed $var
 * @return object|null
 */
function var_get_optional_object(mixed $var): ?object
{
    return is_object($var) ? $var : null;
}

/**
 * Attempt to retrieve a resource from the given value,
 * return null on failure.
 *
 * @param mixed $var
 * @return resource|null
 */
function var_get_optional_resource(mixed $var)
{
    return is_resource($var) ? $var : null;
}

/**
 * Attempt to retrieve an array from the given value,
 * return null on failure.
 *
 * @param mixed $var
 * @return array|null
 */
function var_get_optional_array(mixed $var): ?array
{
    return is_array($var) ? $var : null;
}

/**
 * Attempt to retrieve a callable from the given value,
 * return null on failure.
 *
 * @param mixed $var
 * @return callable|null
 */
function var_get_optional_callable(mixed $var): ?callable
{
    return is_callable($var) ? $var : null;
}
