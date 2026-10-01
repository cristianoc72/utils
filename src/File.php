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
 * SplFileinf class supporting relative paths and other useful methods for files manipulation.
 * The base SplFileInfo class contains the full path of the file, so `getPathname()` returns the full path. This class adds a relative path to the file,
 * so `getFullPathname()` returns the full path of the file, including the relative path.
 */
class File extends SplFileInfo
{
    /**
     * @var string The relative path.
     */
    protected string $relativePath = '';

    final public function __construct(string $filename, string $relativePath = '')
    {
        if ($relativePath !== '') {
            $this->relativePath = str_ends_with($relativePath, '/') ? $relativePath : $relativePath . '/';
            $filename = str_starts_with($filename, $this->relativePath) ? $filename
                : $this->relativePath . $filename;
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
     * Read the content of the file.
     * This method reads the __full__ content of the file. To read only a certain number
     * of bytes, please use the native `\SplObject::fread()` instead.
     *
     * @return string
     */
    public function getContents(): string
    {
        return $this->fileOperation('get');
    }

    /**
     * Write the given string into the file.
     * This method __overwrite__ the content of the file.
     *
     * @param string $content
     * @return void
     */
    public function putContents(string $content): void
    {
        $this->fileOperation('put', $content);
    }

    /**
     * Append the given string to the end of the file.
     *
     * @param string $content
     * @return void
     */
    public function appendContents(string $content): void
    {
        $this->fileOperation('append', $content);
    }

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
