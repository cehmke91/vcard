<?php

declare(strict_types=1);

namespace App\Enums;

use ReflectionClass;

final class Properties
{
    public const VERSION = 'VERSION';
    public const N = 'N';
    public const FN = 'FN';
    public const ORG = 'ORG';
    public const TITLE = 'TITLE';
    public const PHOTO = 'PHOTO';
    public const ADR = 'ADR';
    public const EMAIL = 'EMAIL';
    public const REV = 'REV';

    public static function exists(string $value): bool
    {
        return array_key_exists(
            $value,
            (new ReflectionClass(self::class))->getConstants()
        );
    }
}