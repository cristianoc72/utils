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
 * Utility methods to manipulate strings, not included into the standard PHP functions list.
 *
 * This class contains static methods to manipulate strings, such as converting
 * to kebab-case, snake_case, StudlyCase, and camelCase.
 * It also provides methods to ensure that a string starts or ends with a specific character.
 *
 * All the static methods are intended to be used with the new [PHP 8.5 pipe operator](https://www.php.net/manual/en/language.operators.functional.php),
 * allowing for a more functional programming style.
 *
 * If you prefer the object-oriented fluent api approach, you can use the `Text` class, included into
 * [phootwork/lang](https://github.com/phootwork/lang) package, or the `UnicodeString` class,
 * from [symfony/string](https://github.com/symfony/string) package, instead.
 *
 * @author Cristiano Cinotti <cristianocinotti@gmail.com>
 * @license MIT
 */
final class StringUtils
{
    /**
     * Collapses multiple consecutive whitespace characters into a single space.
     *
     * @static
     * @param string $toCollapse The string to collapse.
     * @return string The collapsed string.
     * @throws \RuntimeException If an error occurs while collapsing the string.
     */
    public static function collapseSpaces(string $toCollapse): string
    {
        return implode(' ', array_filter(explode(' ', $toCollapse), fn(string $value): bool => $value !== ''));
    }

    /**
     * Convert this string into kebab-case. Numbers are considered as part of its previous piece.
     *
     * In example:
     *
     * ```php
     * <?php
     *
     *  use Susina\Utils\StringUtils;
     *
     *  $var = StringUtils::toKebabCase('myOwnVariable'); // my-own-variable
     *
     *  $var = StringUtils::toKebabCase('myTest3Variable'); // my-test3-variable
     * ```
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
     * In example:
     *
     * ```php
     * <?php
     *
     *  use Susina\Utils\StringUtils;
     *
     *  $var = StringUtils::toSnakeCase('myOwnVariable'); // my_own_variable
     *
     *  $var = StringUtils::toSnakeCase('myTest3Variable'); // my_test3_variable
     * ```
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
     * In example:
     *
     * ```php
     * <?php
     *
     *  use Susina\Utils\StringUtils;
     *
     *  $var = StringUtils::toStudlyCase('my_own_variable'); // MyOwnVariable
     *
     *  $var = StringUtils::toStudlyCase('my_test3_variable'); // MyTest3Variable
     * ```
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
     * StudlyCase is also known as PascalCase, and this method is provided for convenience.
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
     * In example:
     *
     * ```php
     * <?php
     *
     *  use Susina\Utils\StringUtils;
     *
     *  $var = StringUtils::toCamelCase('my_own_variable'); // myOwnVariable
     *
     *  $var = StringUtils::toCamelCase('my_test3_variable'); // myTest3Variable
     * ```
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
     * In example:
     *
     * ```php
     * <?php
     *
     *  use Susina\Utils\StringUtils;
     *
     *
     *  $var = StringUtils::ensureEnd('my/personal/path', '/'); // my/personal/path/ added the trailing slash
     *
     *  $var = StringUtils::ensureEnd('my/personal/path/', '/'); // my/personal/path/ no change, already ends with slash
     *
     * ```
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
     * In example:
     *
     * ```php
     * <?php
     *
     *  use Susina\Utils\StringUtils;
     *
     *
     *  $var = StringUtils::ensureStart('my/personal/path', '/'); // /my/personal/path added the leading slash
     *
     *  $var = StringUtils::ensureStart('/my/personal/path', '/'); // /my/personal/path no change, already starts with slash
     * ```
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
