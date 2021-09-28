<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Properties;
use App\Exceptions\InvalidPropertyException;

class VcfInterpretor
{
    /**
     * Interprets a line from a VCS document and passes it back
     * in an associative array form.
     */
    public function interpret(string $line): array
    {   
        $data = explode(':', $line, 2);
        try {
            $property = $data[0];

            if (! Properties::exists($property)) {
                throw new InvalidPropertyException();
            }

            switch ($property) {
                case 'N':
                    return $this->readName($data);

                case 'ADR':
                    return $this->readAddress($data);

                case 'PHOTO':
                    return $this->readPhoto($data);

                case 'ORG':
                    return $this->readOrg($data);

                default:
                    return $this->readString($data);
            }
        } catch (InvalidPropertyException $e) {
            // This is just here for show. In reality we may want
            // to handle the exception. For now we just ignore it.
            // (which can also be valid)
            return [];
        }
    }

    /** Read a string line value and pass it back as a key=>value pair. */
    private function readString(array $data): array
    {
        return [$data[0] => $data[1]];
    }

    /** Parse and read a name line from the vcf file and return the result. */
    private function readName(array $data): array
    {
        return $this->readArray($data, [
            'surname', 'givenNames', 'additionalNames', 'honorificPrefix', 'honorificSuffix',
        ]);
    }

    /** Parse and read an address line from the vcf file and return the result. */
    private function readAddress(array $data): array
    {
        return $this->readArray($data, [
            'POBox', 'extendedAddress', 'streetAddress', 'locality', 'region',
            'postalCode', 'countryName',
        ]);
    }

    /** Parse and read a photo line from the vcf file and return the result. */
    private function readPhoto(array $data): array
    {
        return $this->readArray($data, [
            'mimeType', 'url',
        ]);
    }

    /** Parse and read a photo line from the vcf file and return the result. */
    private function readOrg(array $data): array
    {
        $data[1] = str_replace(';', ' ', $data[1]);

        return $this->readString($data);
    }

    /**
     * Received a read in data array and an array of keys.
     * Returns the data array mapped to the keys, in the order
     * the keys were given.
     */
    private function readArray(array $data, array $keys): array
    {
        $values = explode(';', $data[1]);
        
        $output = [];
        foreach ($keys as $i => $key) {
            $output[$key] = trim($values[$i] ?? '');
        }

        return [$data[0] => $output];
    }
}