<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Services\FileHandlerInterface;

class VcfFileHandler implements FileHandlerInterface
{
    /**
     * Parses a vcf file returning the contents as an array.
     * 
     * @return array<string>
     */
    public function read(string $filepath): array
    {
        $contents = file($filepath);
        $contents = $this->unfold($contents);

        return $contents;
    }

    /** Writes the contents to a vcf file. */
    public function write(string $filepath, array $contents): void
    {
        /**
         * Nothing to see here yet. Just an example of what might be.
         * In this case refolding the content to never be longer than
         * 75 characters.
         */
    }

    /**
     * Takes an array of fileContents from a vcf file and unfolds them.
     * vcf Files may contain multi-line content, this is denoted by the
     * line beginning with a space character ' '. returns an array with
     * each content item in a single element.
     * 
     * @return array<string>
     */
    private function unfold(array $fileContents): array
    {
        $unfoldedContents = [];
        foreach ($fileContents as $contentLine) {
            $contentLine = str_replace(PHP_EOL, '', $contentLine);

            if ($contentLine[0] === ' ') {
                $unfoldedContents[count($unfoldedContents) - 1] .= $contentLine;
                continue; 
            }

            $unfoldedContents[] = $contentLine;
        }

        return $unfoldedContents;
    }
}