<?php

declare(strict_types=1);

/*
 * Copyright (c) Cristiano Cinotti
 *
 * This file is part of susina/utils package, released under the MIT license.
 * For the full copyright and license information, please view the LICENSE file distributed
 * with this source code.
 */

namespace Susina\Utils\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Susina\Utils\StringUtils;

class StringUtilsTest extends TestCase
{
    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'providerForCollapseSpaces')]
    public function testCollapseSpaces(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::collapseSpaces($text));
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'providerForToKebabCase')]
    public function testToKebabCase(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::toKebabCase($text));
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'providerForToSnakeCase')]
    public function testToSnakeCase(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::toSnakeCase($text));
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'providerForToStudlyCase')]
    public function testToStudlyCase(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::toStudlyCase($text));
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'providerForToStudlyCase')]
    public function testToPascalCase(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::toPascalCase($text));
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'providerForToCamelCase')]
    public function testToCamelCase(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::toCamelCase($text));
    }

    public function testEnsureEnd(): void
    {
        $pathWithout = "path/without/trailing";
        $pathWith = "path/with/trailing/";

        $this->assertSame("path/without/trailing/", StringUtils::ensureEnd($pathWithout, '/'));
        $this->assertSame("path/with/trailing/", StringUtils::ensureEnd($pathWith, '/'));
    }

    public function testEnsureStart(): void
    {
        $pathWithout = "path/without/trailing";
        $pathWith = "/path/with/trailing";

        $this->assertSame("/path/without/trailing", StringUtils::ensureStart($pathWithout, '/'));
        $this->assertSame("/path/with/trailing", StringUtils::ensureStart($pathWith, '/'));
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'pluralFormProvider')]
    public function testPluralize(string $input, string $expected): void
    {
        $this->assertSame($expected, StringUtils::pluralize($input));
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'pluralFormProvider')]
    public function testSingularize(string $expected, string $input): void
    {
        $this->assertSame($expected, StringUtils::singularize($input));
    }
}
