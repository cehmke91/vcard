<?php

declare(strict_types=1);

namespace App\Models;

/** 
 * Photo as specified on RFC6350 under 6.2.4 (PHOTO)
 * @see https://www.rfc-editor.org/rfc/rfc6350.txt
 */
class Photo extends Model
{
    protected string $url;
    protected ?string $mimeType;

    public function __construct(
        string $url,
        string $mimeType,
    )
    {
        $this->url = $url;
        $this->mimeType = $mimeType;
    }
}