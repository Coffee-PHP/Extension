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

if (!function_exists('var_get_int')) {
    /**
     * Cast the mixed value to an
     * integer and return it.
     *
     * @param mixed $var
     * @return int
     * @noinspection TypeUnsafeComparisonInspection
     */
    function var_get_int($var): int
    {
        try {
            if (is_bool($var)) {
                return $var ? 1 : 0;
            }
            $intVal = (int)$var;
            if (is_float($var)) {
                if ($var == $intVal) {
                    return $intVal;
                }
            } elseif ((string)$intVal === (string)$var) {
                return $intVal;
            }
            throw new BadFunctionCallException("Failed to cast value '$var' to an integer.");
        } catch (BadFunctionCallException $e) {
            throw $e;
        } catch (Throwable $e) {
            $type = gettype($var);
            throw new BadFunctionCallException("Failed to cast value of type '$type' to an integer.");
        }
    }
}

if (!function_exists('var_get_string')) {
    /**
     * Cast the mixed value to a
     * string and return it.
     *
     * @param mixed $var
     * @return string
     */
    function var_get_string($var): string
    {
        try {
            if (is_bool($var)) {
                return $var ? '1' : '0';
            }
            if ($var === null) {
                throw new BadFunctionCallException('Failed to cast null value to string.');
            }
            return (string)$var;
        } catch (BadFunctionCallException $e) {
            throw $e;
        } catch (Throwable $e) {
            $type = gettype($var);
            throw new BadFunctionCallException("Failed to cast value of type '$type' to a string.");
        }
    }
}

if (!function_exists('var_get_float')) {
    /**
     * Cast the mixed value to a
     * floating point number and
     * return it.
     *
     * @param mixed $var
     * @return float
     */
    function var_get_float($var): float
    {
        try {
            if (is_bool($var)) {
                return $var ? 1.0 : 0.0;
            }
            if (is_numeric($var)) {
                return (float)$var;
            }
            throw new BadFunctionCallException("Failed to cast value '$var' to a floating-point number.");
        } catch (BadFunctionCallException $e) {
            throw $e;
        } catch (Throwable $e) {
            $type = gettype($var);
            throw new BadFunctionCallException("Failed to cast value of type '$type' to a floating-point number.");
        }
    }
}

if (!function_exists('var_get_bool')) {
    /**
     * Cast the mixed value to
     * a boolean and return it.
     *
     * @param mixed $var
     * @return bool
     */
    function var_get_bool($var): bool
    {
        try {
            if (is_bool($var)) {
                return $var;
            }
            $mixedString = (string)strtoupper((string)$var);
            if (in_array($mixedString, ['1', 'YES', 'ON', 'TRUE'], true)) {
                return true;
            }
            if (in_array($mixedString, ['0', 'NO', 'OFF', 'FALSE'], true)) {
                return false;
            }
            throw new BadFunctionCallException("Failed to cast value '$var' to a boolean.");
        } catch (BadFunctionCallException $e) {
            throw $e;
        } catch (Throwable $e) {
            $type = gettype($var);
            throw new BadFunctionCallException("Failed to cast value of type '$type' to a boolean.");
        }
    }
}

if (!function_exists('var_get_object')) {
    /**
     * Cast the mixed value to
     * an object and return it.
     *
     * @param mixed $var
     * @return object
     */
    function var_get_object($var): object
    {
        try {
            if (is_object($var)) {
                return $var;
            }
            throw new BadFunctionCallException("Failed to cast '$var' to an object.");
        } catch (BadFunctionCallException $e) {
            throw $e;
        } catch (Throwable $e) {
            $type = gettype($var);
            throw new BadFunctionCallException("Failed to cast value of '$type' to an object.");
        }
    }
}

if (!function_exists('var_get_resource')) {
    /**
     * Cast the mixed value to
     * a resource and return it.
     *
     * @param mixed $var
     * @return resource
     */
    function var_get_resource($var)
    {
        try {
            if (is_resource($var)) {
                return $var;
            }
            throw new BadFunctionCallException("Failed to cast value '$var' to a resource.");
        } catch (BadFunctionCallException $e) {
            throw $e;
        } catch (Throwable $e) {
            $type = gettype($var);
            throw new BadFunctionCallException("Failed to cast value of type '$type' to a resource.");
        }
    }
}

if (!function_exists('var_get_array')) {
    /**
     * Cast the mixed value
     * to an array and return it.
     *
     * @param mixed $var
     * @return array
     */
    function var_get_array($var): array
    {
        try {
            if (is_array($var)) {
                return $var;
            }
            throw new BadFunctionCallException("Failed to cast value '$var' to an array.");
        } catch (BadFunctionCallException $e) {
            throw $e;
        } catch (Throwable $e) {
            $type = gettype($var);
            throw new BadFunctionCallException("Failed to cast value of type '$type' to an array.");
        }
    }
}

if (!function_exists('var_get_callable')) {
    /**
     * Cast the mixed value to
     * a callable and return it.
     *
     * @param mixed $var
     * @return callable
     */
    function var_get_callable($var): callable
    {
        try {
            if (is_callable($var)) {
                return $var;
            }
            throw new BadFunctionCallException("Failed to cast value '$var' to a callable.");
        } catch (BadFunctionCallException $e) {
            throw $e;
        } catch (Throwable $e) {
            $type = gettype($var);
            throw new BadFunctionCallException("Failed to cast value of type '$type' to a callable.");
        }
    }
}

if (!function_exists('var_get_optional_int')) {
    /**
     * Attempt to convert the
     * mixed value to an integer.
     *
     * Return null on failure.
     *
     * @param mixed $var
     * @return int|null
     */
    function var_get_optional_int($var): ?int
    {
        try {
            return var_get_int($var);
        } catch (Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('var_get_optional_string')) {
    /**
     * Attempt to convert the mixed
     * value to a string.
     *
     * Return null on failure.
     *
     * @param mixed $var
     * @return string|null
     */
    function var_get_optional_string($var): ?string
    {
        try {
            return var_get_string($var);
        } catch (Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('var_get_optional_float')) {
    /**
     * Attempt to convert the mixed
     * value to a floating point number.
     *
     * Return null on failure.
     *
     * @param mixed $var
     * @return float|null
     */
    function var_get_optional_float($var): ?float
    {
        try {
            return var_get_float($var);
        } catch (Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('var_get_optional_bool')) {
    /**
     * Attempt to convert the mixed
     * value to a boolean.
     *
     * Return null on failure.
     *
     * @param mixed $var
     * @return bool|null
     */
    function var_get_optional_bool($var): ?bool
    {
        try {
            return var_get_bool($var);
        } catch (Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('var_get_optional_object')) {
    /**
     * Attempt to convert the
     * mixed value to an object.
     *
     * Return null on failure.
     *
     * @param mixed $var
     * @return object|null
     */
    function var_get_optional_object($var): ?object
    {
        try {
            return var_get_object($var);
        } catch (Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('var_get_optional_resource')) {
    /**
     * Attempt to convert the
     * mixed value to a resource.
     *
     * Return null on failure.
     *
     * @param mixed $var
     * @return resource|null
     */
    function var_get_optional_resource($var)
    {
        try {
            return var_get_resource($var);
        } catch (Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('var_get_optional_array')) {
    /**
     * Attempt to convert the
     * mixed value to an array.
     *
     * Return null on failure.
     *
     * @param mixed $var
     * @return array|null
     */
    function var_get_optional_array($var): ?array
    {
        try {
            return var_get_array($var);
        } catch (Throwable $e) {
            return null;
        }
    }
}

if (!function_exists('var_get_optional_callable')) {
    /**
     * Attempt to convert the
     * mixed value to a callable.
     *
     * Return null on failure.
     *
     * @param mixed $var
     * @return callable|null
     */
    function var_get_optional_callable($var): ?callable
    {
        try {
            return var_get_callable($var);
        } catch (Throwable $e) {
            return null;
        }
    }
}
