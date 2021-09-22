<?php

declare(strict_types=1);

namespace App;

use App\Factories\VCardFactory;
use App\Services\VcfFileHandler;
use App\Services\VcfInterpretor;

/** Parses a .vcf file and outputs an array of VCard objects. */
class vCardParser
{
    private VcfFileHandler $fileHandler;
    private VcfInterpretor $interpretor;
    private VCardFactory $factory;


    public function __construct(
        VcfFileHandler $fileHandler,
        VcfInterpretor $interpretor,
        VCardFactory $factory
    )
    {
        $this->fileHandler = $fileHandler;
        $this->interpretor = $interpretor;
        $this->factory = $factory;
    }

    /** Parse the contents of a .vcs file and return the result. */
    public function parse(string $filePath): array
    {
        $contents = $this->fileHandler->read($filePath);

        $vCards = [];
        foreach ($contents as $line) {
            if ($this->isEndOfCard($line)) {
                $vCards[] = $this->factory->build();
                continue;
            }

            if ($this->isStartOfCard($line)) {
                $this->factory->clear();
                continue;
            }

            $data = $this->interpretor->interpret($line);
            $this->factory->include($data);
        }

        return $vCards;
    }

    /** Determine if the line denotes the start of a new card. */
    private function isStartOfCard(string $line): bool
    {
        return $line === 'BEGIN:VCARD';
    }

    /** Determine if the line denotes the end of a card. */
    private function isEndOfCard(string $line): bool
    {
        return $line === 'END:VCARD';
    }
}