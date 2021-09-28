<?php

declare(strict_types=1);

namespace App\Interfaces\Transformers;

use App\Models\VCard;

interface TransformerInterface
{
    /**
     * Transforms a vCard to a diffrent format.
     *
     * @param array<VCard> $vCards
     * @return string
     */
    function transform(array $vCards): string;
}