<?php

declare(strict_types=1);

namespace App\Transfromers;

use App\Interfaces\Transformers\TransformerInterface;
use App\Models\VCard;

/** Transforms an array of VCard objects into an HTML representation */
class HtmlTransformer implements TransformerInterface
{
    public function transform(array $vCards): string
    {
        $htmlVCards = "<ul class=\"v-cards\">\n";

        foreach ($vCards as $vCard) {
            $htmlVCards .= $this->toHtml($vCard);
        }

        $htmlVCards .= "</ul>\n";

        return $htmlVCards;
    }

    private function toHtml(VCard $vCard): string
    {
        $htmlCard = "\t<li>\n\t\t<div class=\"v-card\">\n";

        $N = $vCard->get('N');
        $htmlCard .= "\t\t\t<div class\"v-card__n\">\n"
            . "\t\t\t\t<span class\"v-card__n__surname\">" . $N->get('surname') . "</span>\n"
            . "\t\t\t\t<span class\"v-card__n__given-name\">" . $N->get('givenNames') . "</span>\n"
            . "\t\t\t\t<span class\"v-card__n__additional-names\">" . $N->get('additionalNames') . "</span>\n"
            . "\t\t\t\t<span class\"v-card__n__honorific-prefix\">" . $N->get('honorificPrefix') . "</span>\n"
            . "\t\t\t\t<span class\"v-card__n__honorific-suffix\">" . $N->get('honorificSuffix') . "</span>\n"
            . "\t\t\t</div>\n";

        $FN = $vCard->get('FN');
        if ($FN) {
            $htmlCard .= "\t\t\t<div class=\"v-card__fn\">$FN</div>\n";
        }

        $PHOTO = $vCard->get('PHOTO');
        if ($PHOTO) {
            $htmlCard .= "\t\t\t<div class=\"v-card__photo\">\n"
                . "\t\t\t\t<img src=\"" . $PHOTO->get('url') . "\" alt=\"vCard Photo\" />\n"
                . "\t\t\t</div>\n";
        }

        $ADR = $vCard->get('ADR');
        if ($ADR) {
            $htmlCard .= "\t\t\t<div class=\"v-card__adr\">\n"
                . "\t\t\t\t<span class=\"v-card__adr__street\">" . $ADR->get('streetAddress') . "</span>\n"
                . "\t\t\t\t<span class=\"v-card__adr__locality\">" . $ADR->get('locality') . "</span>\n"
                . "\t\t\t\t<span class=\"v-card__adr__region\">" . $ADR->get('region') . "</span>\n"
                . "\t\t\t\t<span class=\"v-card__adr__postalCode\">" . $ADR->get('postalCode') . "</span>\n"
                . "\t\t\t\t<span class=\"v-card__adr__countryName\">" . $ADR->get('countryName') . "</span>\n"
                . "\t\t\t</div>";
        }

        $EMAIL = $vCard->get('EMAIL');
        if ($EMAIL) {
            $htmlCard .= "\t\t\t<div class=\"v-card__fn\">$EMAIL</div>\n";
        }

        $TITLE = $vCard->get('TITLE');
        if ($TITLE) {
            $htmlCard .= "\t\t\t<div class=\"v-card__fn\">$TITLE</div>\n";
        }

        $ORG = $vCard->get('ORG');
        if ($ORG) {
            $htmlCard .= "\t\t\t<div class=\"v-card__fn\">$ORG</div>\n";
        }

        $htmlCard .= "\t\t</div>\n\t</li>\n";

        return $htmlCard;
    }
}