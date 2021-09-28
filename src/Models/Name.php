<?php

declare(strict_types=1);

namespace App\Models;

/** 
 * Name as specified on RFC6350 under 6.2.2 (N)
 * @see https://www.rfc-editor.org/rfc/rfc6350.txt
 */
class Name extends Model
{
    protected string $surname;
    protected ?string $givenNames;
    protected ?string $additionalNames;
    protected ?string $honorificPrefix;
    protected ?string $honorificSuffix;

    public function __construct(
        string $surname = null,
        string $givenNames = null,
        string $additionalNames = null,
        string $honorificPrefix = null,
        string $honorificSuffix = null,
    )
    {
        $this->surname = $surname;
        $this->givenNames = $givenNames;
        $this->additionalNames = $additionalNames;
        $this->honorificPrefix = $honorificPrefix;
        $this->honorificSuffix = $honorificSuffix;
    }
}