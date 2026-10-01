<?php

declare(strict_types=1);

/*
 * Copyright (c) Cristiano Cinotti
 *
 * This file is part of susina/utils package, released under the MIT license.
 * For the full copyright and license information, please view the LICENSE file distributed
 * with this source code.
 */

namespace Susina\Utils;

/**
 * Utility methods to manipulate strings, not included in PHP functions list.
 */
final class StringUtils
{
    /**
     * Collapses multiple consecutive whitespace characters into a single space.
     *
     * @static
     * @param string $toCollapse
     * @return string
     * @throws \RuntimeException If an error occurs while collapsing the string.
     */
    public static function collapseSpaces(string $toCollapse): string
    {
        return implode(' ', array_filter(explode(' ', $toCollapse), fn(string $value): bool => $value !== ''));
    }

    /**
     * Convert this string into kebab-case. Numbers are considered as part of its previous piece.
     *
     * <code>
     * $var = new Text('myOwnVariable');<br>
     * $var->toKebabCase(); // my-own-variable
     *
     * $var = new Text('myTest3Variable');<br>
     * $var->toKebabCase(); // my-test3-variable
     * </code>
     *
     * @static
     * @param string $text
     * @return string
     */
    public static function toKebabCase(string $text): string
    {
        return trim($text, '-_')
            |> (fn(string $x): string => str_replace('_', ' ', $x))
            |> self::collapseSpaces(...)
            |> (fn(string $x): string => str_replace(' ', '-', $x))
            |> (fn(string $x): string => (string) preg_replace('/([a-z0-9])([A-Z])/', '$1-$2', $x))
            |> mb_strtolower(...)
        ;
    }

    /**
     * Converts this string into snake_case. Numbers are considered as part of its previous piece.
     *
     * <code>
     * $var = new Text('myOwnVariable');<br>
     * $var->toSnakeCase(); // my_own_variable
     *
     * $var = new Text('myTest3Variable');<br>
     * $var->toSnakeCase(); // my_test3_variable
     * </code>
     *
     * @static
     * @param string $text
     * @return string
     */
    public static function toSnakeCase(string $text): string
    {
        return str_replace('-', '_', self::toKebabCase($text));
    }

    /**
     * Converts this string into StudlyCase. Numbers are considered as part of its previous piece.
     *
     * <code>
     * $var = new Text('my_own_variable');<br>
     * $var->toStudlyCase(); // MyOwnVariable
     *
     * $var = new Text('my_test3_variable');<br>
     * $var->toStudlyCase(); // MyTest3Variable
     * </code>
     *
     * @static
     * @param string $text
     * @return string
     */
    public static function toStudlyCase(string $text): string
    {
        return trim($text, '-_')
            |> (fn(string $x): string => str_replace(['-', '_'], ' ', $x))
            |> self::collapseSpaces(...)
            |> (fn(string $x): array => explode(' ', $x))
            |> (fn(array $arr): array => array_map('mb_ucfirst', $arr))
            |> implode(...)
        ;
    }

    /**
     * Alias for toStudlyCase() method.
     *
     * @static
     * @param string $text
     * @return string
     */
    public static function toPascalCase(string $text): string
    {
        return self::toStudlyCase($text);
    }

    /**
     * Converts this string into camelCase. Numbers are considered as part of its previous piece.
     *
     * <code>
     * $var = new Text('my_own_variable');<br>
     * $var->toCamelCase(); // myOwnVariable
     *
     * $var = new Text('my_test3_variable');<br>
     * $var->toCamelCase(); // myTest3Variable
     * </code>
     *
     * @static
     * @param string $text
     * @return string
     */
    public static function toCamelCase(string $text): string
    {
        return mb_lcfirst(self::toStudlyCase($text));
    }

    /**
     * Ensure that the `$root` string ends with `$char` character/string.
     *
     * @static
     * @param string $root The string to manipulate.
     * @param string $char The char the given string should end with
     * @return string The string ending with the given character.
     */
    public static function ensureEnd(string $root, string $char): string
    {
        return str_ends_with($root, $char) ? $root : $root . $char;
    }

    /**
     * Ensure that the `$root` string starts with `$char` character/string.
     *
     * @static
     * @param string $root The string to manipulate.
     * @param string $char The char the given string should start with
     * @return string The string starting with the given character.
     */
    public static function ensureStart(string $root, string $char): string
    {
        return str_starts_with($root, $char) ? $root : $char . $root;
    }
}
