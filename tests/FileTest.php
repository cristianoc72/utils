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

use RuntimeException;
use Susina\Utils\File;

class FileTest extends VfsTestCase
{
    public function testAbsolute(): void
    {

        $win = new File('c:\\windows');
        $this->assertTrue($win->isAbsolute());

        $unix = new File('/etc');
        $this->assertTrue($unix->isAbsolute());

        $win = new File('\\windows\\system');
        $this->assertTrue($win->isAbsolute());

        $null = new File('');
        $this->assertFalse($null->isAbsolute());

        $current = new File('./some/dir');
        $this->assertFalse($current->isAbsolute());

        $abs = new File(__FILE__);
        $this->assertTrue($abs->isAbsolute());

        $stream = new File('file:///Home/Documents');
        $this->assertTrue($stream->isAbsolute());
    }

    public function testGetContents(): void
    {
        $json = '{"hello":"world!"}';
        $this->createFile('dir/composer.json', $json);
        $file = new File($this->root->url() . '/dir/composer.json');

        $this->assertEquals($json, $file->getContents());
    }

    public function testGetContentsFromUnreadableFile(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageIsOrContains('file_get_contents(vfs://root/nonreadable.txt): Failed to open stream:');

        $testFile = $this->createFile('nonreadable.txt', 'I am not readable.')->chmod(000);
        $file = new File($testFile->url());
        $file->getContents();
    }

    public function testGetContentsFromNonExistentFile(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageIsOrContains('file_get_contents(vfs://root/composer.json): Failed to open stream:');

        $file = new File($this->root->url() . '/composer.json');
        $file->getContents();
    }

    public function testPutContents(): void
    {
        $vfsFile = $this->createFile('writeable.txt', '');
        $file = new File($vfsFile->url());
        $this->assertSame('', $file->getContents());

        $newContent = "This is the new content of the file.";
        $file->putContents($newContent);
        $this->assertSame($newContent, $file->getContents());
    }

    public function testPutContentsIntoNotExistentFileCreatesIt(): void
    {
        $content = "This is the new content of the file.";
        $this->assertFileDoesNotExist($this->root->url() . '/not_existent.txt');

        $file = new File($this->root->url() . '/not_existent.txt');
        $file->putContents($content);

        $this->assertFileExists($this->root->url() . '/not_existent.txt');
        $this->assertSame($content, $file->getContents());
    }

    public function testPutContentsInUnwritableFileThrowsException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageIsOrContains('file_put_contents(vfs://root/myfile.txt): Failed to open stream:');

        $stream = $this->createFile('myfile.txt', '')->chmod(000);
        $file = new File($stream->url());

        $file->putContents('Some content.');
    }

    public function testAppendContents(): void
    {
        $vfsFile = $this->createFile('writeable.txt', 'This is the content of the file.');
        $file = new File($vfsFile->url());
        $file->appendContents("\nThis is the appended content.");
        $this->assertSame("This is the content of the file.\nThis is the appended content.", $file->getContents());
    }

    public function testAppendContentsIntoNotExistentFileCreatesIt(): void
    {
        $content = "This is the appended content.";
        $this->assertFileDoesNotExist($this->root->url() . '/not_existent.txt');

        $file = new File($this->root->url() . '/not_existent.txt');
        $file->appendContents($content);

        $this->assertFileExists($this->root->url() . '/not_existent.txt');
        $this->assertSame($content, $file->getContents());
    }

    public function testAppendContentsInUnwritableFileThrowsException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageIsOrContains('file_put_contents(vfs://root/myfile.txt): Failed to open stream:');

        $stream = $this->createFile('myfile.txt', 'Some content.')->chmod(000);
        $file = new File($stream->url());

        $file->appendContents('Some contentto append.');
    }

    public function testNotPermittedOperationThrowsException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessageIs('Operation "wrong" not permitted on files.');

        $file = new ExtendedFile($this->root->url());
        $file->wrongOperation();
    }

    public function testRelativePath(): void
    {
        $file = new File('html/index.php', '/var/www');

        $this->assertSame('/var/www/', $file->getRelativePath());
        $this->assertSame('html/index.php', $file->getRelativePathname());
        $this->assertSame('/var/www/html/index.php', $file->getPathname());
    }

    public function testRelativeMethodsOnAbsolutePathname(): void
    {
        $file = new File('/var/www/html/index.php');

        $this->assertSame('', $file->getRelativePath());
        $this->assertSame('/var/www/html/index.php', $file->getRelativePathname());
        $this->assertSame('/var/www/html/index.php', $file->getPathname());
    }

    public function testMakeRelativeTo(): void
    {
        $file = new File('/var/www/html/index.php');
        $relativeFile = $file->makeRelativeTo('/var/www');

        $this->assertInstanceOf(File::class, $relativeFile);
        $this->assertSame('html/index.php', $relativeFile->getRelativePathname());
        $this->assertSame('/var/www/', $relativeFile->getRelativePath());
        $this->assertSame('/var/www/html/index.php', $relativeFile->getPathname());
    }
}

class ExtendedFile extends File
{
    public function wrongOperation(): void
    {
        $this->fileOperation('wrong');
    }
}
