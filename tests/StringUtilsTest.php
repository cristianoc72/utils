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

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Susina\Utils\StringUtils;

class StringUtilsTest extends TestCase
{
    #[DataProvider('providerForCollapseSpaces')]
    public function testCollapseSpaces(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::collapseSpaces($text));
    }

    #[DataProvider('providerForToKebabCase')]
    public function testToKebabCase(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::toKebabCase($text));
    }

    #[DataProvider('providerForToSnakeCase')]
    public function testToSnakeCase(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::toSnakeCase($text));
    }

    #[DataProvider('providerForToStudlyCase')]
    public function testToStudlyCase(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::toStudlyCase($text));
    }

    #[DataProvider('providerForToStudlyCase')]
    public function testToPascalCase(string $text, string $expected): void
    {
        $this->assertSame($expected, StringUtils::toPascalCase($text));
    }

    #[DataProvider('providerForToCamelCase')]
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

    public static function providerForCollapseSpaces(): array
    {
        return [
            ['Hello World', 'Hello World'],
            ['Hello        World', 'Hello World'],
            ['  Hello   World', 'Hello World'],
            ['  Hello   World   ', 'Hello World'],
            ['', ''],
            [' ', ''],
            ['   ', ''],
        ];
    }

    public static function providerForToKebabCase(): array
    {
        return [
            ['hello world', 'hello-world'],
            ['hello-world', 'hello-world'],
            ['--hello-world', 'hello-world'],
            ['- _hello-world', 'hello-world'],
            ['hello_world', 'hello-world'],
            ['helloWorld', 'hello-world'],
            ['HelloWorld', 'hello-world'],
            ['hello world test', 'hello-world-test'],
            ['      hello            world test    ', 'hello-world-test'],
            ['hello-world-test', 'hello-world-test'],
            ['hello_world_test', 'hello-world-test'],
            ['helloWorldTest', 'hello-world-test'],
            ['HelloWorldTest', 'hello-world-test'],
            ['hello world test 123', 'hello-world-test-123'],
            ['hello-world-test-123', 'hello-world-test-123'],
            ['hello_world_test_123', 'hello-world-test-123'],
            ['helloWorldTest123', 'hello-world-test123'],
            ['HelloWorldTest123', 'hello-world-test123'],
            ['123!      hello            world test    ', '123!-hello-world-test'],
            ['HelLo world Test', 'hel-lo-world-test'],
            ['HELLO WORLD TEST', 'hello-world-test'],
            ['', ''],
        ];
    }

    public static function providerForToSnakeCase(): array
    {
        return [
            ['hello world', 'hello_world'],
            ['hello-world', 'hello_world'],
            ['--hello-world', 'hello_world'],
            ['- _hello-world', 'hello_world'],
            ['hello_world', 'hello_world'],
            ['helloWorld', 'hello_world'],
            ['HelloWorld', 'hello_world'],
            ['hello world test', 'hello_world_test'],
            ['      hello            world test    ', 'hello_world_test'],
            ['hello-world-test', 'hello_world_test'],
            ['hello_world_test', 'hello_world_test'],
            ['helloWorldTest', 'hello_world_test'],
            ['HelloWorldTest', 'hello_world_test'],
            ['hello world test 123', 'hello_world_test_123'],
            ['hello-world-test-123', 'hello_world_test_123'],
            ['hello_world_test_123', 'hello_world_test_123'],
            ['helloWorldTest123', 'hello_world_test123'],
            ['HelloWorldTest123', 'hello_world_test123'],
            ['123!      hello            world test    ', '123!_hello_world_test'],
            ['HelLo world Test', 'hel_lo_world_test'],
            ['HELLO WORLD TEST', 'hello_world_test'],
            ['', ''],
        ];
    }

    public static function providerForToStudlyCase(): array
    {
        return [
            ['hello world', 'HelloWorld'],
            ['hello-world', 'HelloWorld'],
            ['--hello-world', 'HelloWorld'],
            ['- _hello-world', 'HelloWorld'],
            ['hello_world', 'HelloWorld'],
            ['helloWorld', 'HelloWorld'],
            ['HelloWorld', 'HelloWorld'],
            ['hello world test', 'HelloWorldTest'],
            ['      hello            world test    ', 'HelloWorldTest'],
            ['hello-world-test', 'HelloWorldTest'],
            ['hello_world_test', 'HelloWorldTest'],
            ['helloWorldTest', 'HelloWorldTest'],
            ['HelloWorldTest', 'HelloWorldTest'],
            ['hello world test 123', 'HelloWorldTest123'],
            ['hello-world-test-123', 'HelloWorldTest123'],
            ['hello_world_test_123', 'HelloWorldTest123'],
            ['helloWorldTest123', 'HelloWorldTest123'],
            ['HelloWorldTest123', 'HelloWorldTest123'],
            ['123!      hello            world test    ', '123!HelloWorldTest'],
            ['HelLo world Test', 'HelLoWorldTest'],
            ['HELLO WORLD TEST', 'HELLOWORLDTEST'],
            ['', ''],
        ];
    }

    public static function providerForToCamelCase(): array
    {
        return [
            ['hello world', 'helloWorld'],
            ['hello-world', 'helloWorld'],
            ['--hello-world', 'helloWorld'],
            ['- _hello-world', 'helloWorld'],
            ['hello_world', 'helloWorld'],
            ['helloWorld', 'helloWorld'],
            ['HelloWorld', 'helloWorld'],
            ['hello world test', 'helloWorldTest'],
            ['      hello            world test    ', 'helloWorldTest'],
            ['hello-world-test', 'helloWorldTest'],
            ['hello_world_test', 'helloWorldTest'],
            ['helloWorldTest', 'helloWorldTest'],
            ['HelloWorldTest', 'helloWorldTest'],
            ['hello world test 123', 'helloWorldTest123'],
            ['hello-world-test-123', 'helloWorldTest123'],
            ['hello_world_test_123', 'helloWorldTest123'],
            ['helloWorldTest123', 'helloWorldTest123'],
            ['HelloWorldTest123', 'helloWorldTest123'],
            ['123!      hello            world test    ', '123!HelloWorldTest'],
            ['HelLo world Test', 'helLoWorldTest'],
            ['HELLO WORLD TEST', 'hELLOWORLDTEST'],
            ['', ''],
        ];
    }
}
