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
    return filter_var($var, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
}

/**
 * Get a string from the given value.
 *
 * @param mixed $var
 * @return string
 */
function var_get_string(mixed $var): string
{
    return $var;
}

/**
 * Get a floating point from the given value.
 *
 * @param mixed $var
 * @return float
 */
function var_get_float(mixed $var): float
{
    return filter_var($var, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
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
        throw new TypeError(__FUNCTION__ . '(): Return value must be of type bool, null returned');
    }
    return filter_var($var, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
}

/**
 * Get an object from the given value.
 *
 * @param mixed $var
 * @return object
 */
function var_get_object(mixed $var): object
{
    return $var;
}

/**
 * Get a resource from the given value.
 *
 * @param mixed $var
 * @return resource
 */
function var_get_resource(mixed $var)
{
    if (is_resource($var)) {
        return $var;
    }
    throw new TypeError(__FUNCTION__ . '(): Return value must be of type resource, ' . gettype($var) . ' returned');
}

/**
 * Get an array from the given value.
 *
 * @param mixed $var
 * @return array
 */
function var_get_array(mixed $var): array
{
    return $var;
}

/**
 * Get a callable from the given value.
 *
 * @param mixed $var
 * @return callable
 */
function var_get_callable(mixed $var): callable
{
    return $var;
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
    try {
        return var_get_int($var);
    } catch (Throwable) {
        return null;
    }
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
    try {
        return var_get_string($var);
    } catch (Throwable) {
        return null;
    }
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
    try {
        return var_get_float($var);
    } catch (Throwable) {
        return null;
    }
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
    try {
        return var_get_bool($var);
    } catch (Throwable) {
        return null;
    }
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
    try {
        return var_get_object($var);
    } catch (Throwable) {
        return null;
    }
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
    try {
        return var_get_resource($var);
    } catch (Throwable) {
        return null;
    }
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
    try {
        return var_get_array($var);
    } catch (Throwable) {
        return null;
    }
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
    try {
        return var_get_callable($var);
    } catch (Throwable) {
        return null;
    }
}
