<?php

declare(strict_types=1);

namespace App\Interfaces\Services;

interface FileHandlerInterface
{
    /**
     * Read the contents of a file and return the result as an array.
     *
     * @param string $filepath
     * @return array
     */
    public function read(string $filepath): array;

    /**
     * Write contents to a file.
     * Each element in the input array is a new line.
     *
     * @param string $filepath
     * @param array $contents
     * @return void
     */
    public function write(string $filepath, array $contents): void;
}