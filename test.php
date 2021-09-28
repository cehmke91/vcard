<?php

declare(strict_types=1);

/******************************************************\
 *                      SETTINGS                      *
\******************************************************/
$filepath = '/resources/multi-card.vcf';

/******************************************************\
 *                 BOOT THE APPLICATION               *
\******************************************************/

/**
 * Autoloader. 
 * Iterates over the 'src' directory and requires in all .php files
 */
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(__DIR__ . '/src')
);

foreach ($iterator as $file) {
    $fname = $file->getFilename();
    if (preg_match('%\.php$%', $fname)) {
        require_once $file->getPathname();
    }
}

/******************************************************\
 *                 RUN THE APPLICATION                *
\******************************************************/

use App\vCardParser;
use App\Factories\VCardFactory;
use App\Services\VcfFileHandler;
use App\Services\VcfInterpretor;
use App\Transfromers\HtmlTransformer;

$parser = new vCardParser(
    new VcfFileHandler(),
    new VcfInterpretor(),
    new VCardFactory(),
);

$vCards = $parser->parse(__DIR__ . $filepath);

echo (new HtmlTransformer())->transform($vCards);
