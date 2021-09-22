<?php

declare(strict_types=1);

namespace App\Factories;

use App\Models\Name;
use App\Models\Photo;
use App\Models\VCard;
use App\Enums\Properties;
use App\Exceptions\RequiredPropertyException;
use App\Models\Address;

class VCardFactory
{
    /** Components that will be used to construct a vCard. */
    private array $components = [];

    /** The following properties must exsit on a vCard. */
    private array $requiredProperties = [Properties::N];

    /** Clears out the components stored on this factory. */
    public function clear(): void
    {
        $this->components = [];
    }

    /**  Builds a vCard using the current components stored on the factory. */
    public function build(): vCard
    {        
        foreach ($this->requiredProperties as $requiredProperty) {
            if (! array_key_exists($requiredProperty, $this->components)) {
                throw new RequiredPropertyException($requiredProperty);
            }
        }

        $vCard = new VCard(new Name(
            $this->components[Properties::N]['surname'],
            $this->components[Properties::N]['givenNames'] ?? null,
            $this->components[Properties::N]['additionalName'] ?? null,
            $this->components[Properties::N]['honorificPrefix'] ?? null,
            $this->components[Properties::N]['honorificSuffix'] ?? null,
        ));

        $vCard->set(Properties::FN, $this->components[Properties::FN] ?? null);
        $vCard->set(Properties::EMAIL, $this->components[Properties::EMAIL] ?? null);
        $vCard->set(Properties::TITLE, $this->components[Properties::TITLE] ?? null);
        $vCard->set(Properties::ORG, $this->components[Properties::ORG] ?? null);

        if (array_key_exists(Properties::PHOTO, $this->components)) {            
            $vCard->set(Properties::PHOTO, new Photo(
                $this->components[Properties::PHOTO]['url'],
                $this->components[Properties::PHOTO]['mimeType'],
            ));
        }

        if (array_key_exists(Properties::ADR, $this->components)) {            
            $vCard->set(Properties::ADR, new Address(
                $this->components[Properties::ADR]['POBox'],
                $this->components[Properties::ADR]['extendedAddress'],
                $this->components[Properties::ADR]['streetAddress'],
                $this->components[Properties::ADR]['locality'],
                $this->components[Properties::ADR]['region'],
                $this->components[Properties::ADR]['postalCode'],
                $this->components[Properties::ADR]['countryName'],
            ));
        }
        
        return $vCard;
    }

    /**
     * Include the given data in the factory components to later build an object.
     * Note: Chainable method.
     */
    public function include(array $data): self
    {
        $this->components = array_merge($this->components, $data);

        return $this;
    }
}