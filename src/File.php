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

use RuntimeException;
use SplFileInfo;

/**
 * SplFileinfo class supporting relative paths and other useful methods for files manipulation.
 *
 * @author Cristiano Cinotti <cristianocinotti@gmail.com>
 * @license MIT
 */
class File extends SplFileInfo
{
    /**
     * @var string The relative path.
     */
    protected string $relativePath = '';

    /**
     * @param string $filename The file name. It can be relative to the path passed as second argument.
     * @param string $relativePath The relative path.
     * @final
     */
    final public function __construct(string $filename, string $relativePath = '')
    {
        if ($relativePath !== '') {
            $this->relativePath = StringUtils::ensureEnd($relativePath, '/');
            $filename = StringUtils::ensureStart($filename, $this->relativePath);
        }

        parent::__construct($filename);
    }

    /**
     * Get the relative path of the file.
     *
     * @return string
     */
    public function getRelativePath(): string
    {
        return $this->relativePath;
    }

    /**
     * Get the relative path and file name.
     *
     * @return string
     */
    public function getRelativePathname(): string
    {
        return str_replace($this->relativePath, '', $this->getPathname());
    }

    /**
     * Try to determine if a path is absolute.
     *
     * The method follows these steps:
     *
     * 1. If the path contains a colon, it is considered absolute (Windows).
     * 2. If the realpath of the path is the same as the path, it is considered absolute.
     * 3. If the path starts with a slash, it is considered absolute (Unix).
     * 4. If the path starts with a backslash, it is considered absolute (Windows UNC).
     *
     * @return bool
     */
    public function isAbsolute(): bool
    {
        $path = $this->getPathname();
        return match (true) {
            str_contains($path, ':') => true,
            realpath($path) === $path => true,
            str_starts_with($path, '/') => true,
            str_starts_with($path, '\\') => true,
            default => false,
        };
    }

    /**
     * Make the current path relative to the one passed as argument.
     * It returns another File object with relative path.
     *
     * @param string $path
     * @return File
     */
    public function makeRelativeTo(string $path): self
    {
        return new self($this->getPathname(), $path);
    }

    /**
     * Read the contents of the file.
     *
     * This method reads the **full** content of the file. To read only a certain number
     * of bytes, please use the native `\SplObject::fread()` instead.
     *
     * Example 1: read the full content of the file:
     *
     * ```php
     * <?php
     *
     *      $file = new File('myfile.txt');
     *      $content = $file->getContents();
     * ```
     *
     * Example 2: read only the first 100 bytes of the file:
     *
     * ```php
     * <?php
     *
     *     $file = new File('myfile.txt');
     *     $fileObject = $file->openFile('r');
     *     $content = $fileObject->fread(100);
     *
     *     // or in a single line
     *     $content = new File('myfile.txt')->openFile('r')->fread(100);
     * ```
     *
     * @return string
     * @throws RuntimeException If the file does not exist, it's not readable or an error occurs while reading it.
     */
    public function getContents(): string
    {
        return $this->fileOperation('get');
    }

    /**
     * Write the given string into the file.
     *
     * This method **overwrite** the content of the file and writes the complete string.
     * To append content to the file, please use the `appendContents()` method instead.
     * If the file does not exist, it will be created.
     *
     * @param string $content
     * @return void
     * @throws RuntimeException If the file does not exist, it's not writable or an error occurs while writing it.
     */
    public function putContents(string $content): void
    {
        $this->fileOperation('put', $content);
    }

    /**
     * Append the given string to the end of the file.
     *
     * This method **append** the content to the file. If the file does not exist, it will be created.
     *
     * @param string $content The content to append.
     * @return void
     * @throws RuntimeException If the file does not exist, it's not writable or an error occurs while writing it.
     */
    public function appendContents(string $content): void
    {
        $this->fileOperation('append', $content);
    }

    /**
     * Perform an operation on the file.
     *
     * @protected
     * @param string $operation The operation to perform. It can be 'get', 'put' or 'append'.
     * @param string $content The content to write or append. It is only used for 'put' and 'append' operations.
     * @throws RuntimeException If the operation is not permitted or an error occurs while performing it.
     * @return string The content of the file for 'get' operation, or an empty string for 'put' and 'append' operations.
     */
    protected function fileOperation(string $operation, string $content = ''): string
    {
        $message = '';
        set_error_handler(
            function (int $errNr, string $errMsg) use (&$message): bool {
                $message = $errMsg;

                return true;
            },
        );

        try {
            $content = match ($operation) {
                'get' => file_get_contents($this->getPathname()),
                'put' => file_put_contents($this->getPathname(), $content),
                'append' => file_put_contents($this->getPathname(), $content, FILE_APPEND),
                default => throw new RuntimeException("Operation \"$operation\" not permitted on files."),
            };
        } finally {
            restore_error_handler();
        }

        if ($content === false) {
            throw new RuntimeException($message);
        }

        return is_string($content) ? $content : '';
    }
}
