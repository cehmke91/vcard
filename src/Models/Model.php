<?php

declare(strict_types=1);

namespace App\Models;

class Model
{
    /** Retrieve the property from a model. */
    public function get(string $property): mixed
    {
        return $this->{$property};
    }

    /** Assign value to the property on a model. */
    public function set(string $property, mixed $value): void
    {
        $this->{$property} = $value;
    }
}