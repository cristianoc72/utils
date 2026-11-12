<?php

declare(strict_types=1);

/*
 * Copyright (c) Cristiano Cinotti
 *
 * This file is part of susina/utils package, released under the MIT license.
 * For the full copyright and license information, please view the LICENSE file distributed
 * with this source code.
 */

namespace Susina\Utils\Test;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Susina\Utils\Inflector\SimpleInflector;

/**
 * Tests for the SimpleInflector class
 */
class SimpleInflectorTest extends TestCase
{
    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'pluralFormProvider')]
    public function testPluralForm($input, $output): void
    {
        $pluralizer = new SimpleInflector();
        $this->assertEquals($output, $pluralizer->pluralize($input));
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'pluralFormProvider')]
    public function testSingularForm($output, $input): void
    {
        $pluralizer = new SimpleInflector();
        $this->assertEquals($output, $pluralizer->singularize($input));
    }

    public function testSingularizeSingularForm(): void
    {
        $pluralizer = new SimpleInflector();
        $this->assertEquals('book', $pluralizer->singularize('book'), '`book` is already singular.');
        $this->assertEquals('Book', $pluralizer->singularize('Book'), '`Book` is already singular.');
        $this->assertEquals('foot', $pluralizer->singularize('foot'), '`foot` is already singular.');
        $this->assertEquals('people', $pluralizer->singularize('people'), '`peolple` is uncountable, so it cannot be singularized.');
        $this->assertEquals('food_menu', $pluralizer->singularize('food_menu'), '`food_menu` is already singular.');
    }

    public function testPluralizePluralForm(): void
    {
        $pluralizer = new SimpleInflector();
        $this->assertEquals('books', $pluralizer->pluralize('books'), '`books` is already plural.');
        $this->assertEquals('Books', $pluralizer->pluralize('Books'), '`Books` is already plural.');
        $this->assertEquals('feet', $pluralizer->pluralize('feet'), '`feet` is already plural.');
        $this->assertEquals('people', $pluralizer->pluralize('people'), '`peolple` is uncountable, so it cannot be pluralized.');
        $this->assertEquals('food_menus', $pluralizer->pluralize('food_menus'), '`food_menus` is already plural.');
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'pluralFormProvider')]
    public function testIsPlural($singular, $plural): void
    {
        $pluralizer = new SimpleInflector();
        $this->assertTrue($pluralizer->isPlural($plural));
    }

    #[DataProviderExternal('Susina\Utils\Tests\DataProvider\StringUtilsDataProvider', 'pluralFormProvider')]
    public function testIsSingular($singular, $plural): void
    {
        $pluralizer = new SimpleInflector();
        $this->assertTrue($pluralizer->isSingular($singular));
    }
}
