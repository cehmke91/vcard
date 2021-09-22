<?php

declare(strict_types=1);

namespace App\Models;

require_once (__DIR__ . '/Model.php');

/** 
 * Address as specified on RFC6350 under 6.3.1 (ADR)
 * @see https://www.rfc-editor.org/rfc/rfc6350.txt
 */
class Address extends Model
{
    /**
     * v3 specification has shown the following values to be
     * plagued with interoperability issues. They should remain empty.
     */
    protected ?string $POBox;
    protected ?string $extendedAddress;

    protected ?string $streetAddress;
    protected ?string $locality; // city
    protected ?string $region; // state / province
    protected ?string $postalCode;
    protected ?string $countryName;

    public function __construct(
        string $POBox = null,
        string $extendedAddress = null,
        string $streetAddress = null,
        string $locality = null,
        string $region = null,
        string $postalCode = null,
        string $countryName = null,
    )
    {
        // See comments on object property as to why these are null.
        $this->POBox = null;
        $this->extendedAddress = null;

        $this->streetAddress = $streetAddress;
        $this->locality = $locality;
        $this->region = $region;
        $this->postalCode = $postalCode;
        $this->countryName = $countryName;
    }
}