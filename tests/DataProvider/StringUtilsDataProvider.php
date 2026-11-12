<?php

declare(strict_types=1);

/*
 * Copyright (c) Cristiano Cinotti
 *
 * This file is part of susina/utils package, released under the MIT license.
 * For the full copyright and license information, please view the LICENSE file distributed
 * with this source code.
 */

namespace Susina\Utils\Tests\DataProvider;

class StringUtilsDataProvider
{
    public static function pluralFormProvider(): array
    {
        return [
            ['', 's'],
            ['user', 'users'],
            ['User', 'Users'],
            ['sheep', 'sheep'],
            ['Sheep', 'Sheep'],
            ['wife', 'wives'],
            ['Wife', 'Wives'],
            ['country', 'countries'],
            ['Country', 'Countries'],
            ['Video', 'Videos'],
            ['video', 'videos'],
            ['Photo', 'Photos'],
            ['photo', 'photos'],
            ['Tomato', 'Tomatoes'],
            ['tomato', 'tomatoes'],
            ['Buffalo', 'Buffaloes'],
            ['buffalo', 'buffaloes'],
            ['typo', 'typos'],
            ['Typo', 'Typos'],
            ['apple', 'apples'],
            ['Apple', 'Apples'],
            ['Man', 'Men'],
            ['man', 'men'],
            ['numen', 'numina'],
            ['Numen', 'Numina'],
            ['bus', 'buses'],
            ['Bus', 'Buses'],
            ['news', 'news'],
            ['News', 'News'],
            ['food_menu', 'food_menus'],
            ['Food_menu', 'Food_menus'],
            ['quiz', 'quizzes'],
            ['Quiz', 'Quizzes'],
            ['alumnus', 'alumni'],
            ['Alumnus', 'Alumni'],
            ['vertex', 'vertices'],
            ['Vertex', 'Vertices'],
            ['matrix', 'matrices'],
            ['Matrix', 'Matrices'],
            ['index', 'indices'],
            ['Index', 'Indices'],
            ['alias', 'aliases'],
            ['Alias', 'Aliases'],
            ['bacillus', 'bacilli'],
            ['Bacillus', 'Bacilli'],
            ['cactus', 'cacti'],
            ['Cactus', 'Cacti'],
            ['focus', 'foci'],
            ['Focus', 'Foci'],
            ['fungus', 'fungi'],
            ['Fungus', 'Fungi'],
            ['nucleus', 'nuclei'],
            ['Nucleus', 'Nuclei'],
            ['radius', 'radii'],
            ['Radius', 'Radii'],
            ['people', 'people'],
            ['People', 'People'],
            ['glove', 'gloves'],
            ['Glove', 'Gloves'],
            ['crisis', 'crises'],
            ['Crisis', 'Crises'],
            ['tax', 'taxes'],
            ['Tax', 'Taxes'],
            ['Tooth', 'Teeth'],
            ['tooth', 'teeth'],
            ['Foot', 'Feet'],
        ];
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
