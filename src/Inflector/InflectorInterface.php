<?php

declare(strict_types=1);

/*
 * Copyright (c) Cristiano Cinotti
 *
 * This file is part of susina/utils package, released under the MIT license.
 * For the full copyright and license information, please view the LICENSE file distributed
 * with this source code.
 */

namespace Susina\Utils\Inflector;

interface InflectorInterface
{
    /**
     * Generate a plural name based on the passed in root.
     *
     * @param  string $root The root that needs to be pluralized (e.g. Author)
     *
     * @return string The plural form of $root (e.g. Authors).
     */
    public function pluralize(string $root): string;

    /**
     * Generate a singular name based on the passed in root.
     *
     * @param  string $root The root that needs to be singularized (e.g. Authors)
     *
     * @return string The singular form of $root (e.g. Author).
     */
    public function singularize(string $root): string;
}
