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

use org\bovigo\vfs\vfsStreamFile;
use PHPUnit\Framework\TestCase as BaseTestCase;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;

class VfsTestCase extends BaseTestCase
{
    public private(set) vfsStreamDirectory $root {
        get => $this->root ??= vfsStream::setup('root');
    }

    public function createFile(string $path, string $content = ''): vfsStreamFile
    {
        $dirs = explode('/', $path);
        $fileName = array_pop($dirs);
        $currentDir = $this->root;

        foreach ($dirs as $dir) {
            if (!$currentDir->hasChild($dir)) {
                $currentDir->addChild(vfsStream::newDirectory($dir));
            }
            $currentDir = $currentDir->getChild($dir);
        }

        return vfsStream::newFile($fileName)->withContent($content)->at($currentDir);
    }
}
