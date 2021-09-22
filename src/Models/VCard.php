<?php

declare(strict_types=1);

namespace App\Models;

/** 
 * vCard as specified under RFC6350
 * @see https://www.rfc-editor.org/rfc/rfc6350.txt 
 */
class VCard extends Model
{
    /** The version of vCard this object represents. */
    protected string $VERSION;

    /** 
     * To specify the components of the name of the object the vCard represents.
     * Cardinality: *1
     */
    protected Name $N;

    /**
     * To specify the formatted text corresponding to the name of the object the vCard represents.
     * Cardinality: 1*
     */
    protected ?string $FN;

    /**
     * To specify an image or photograph information that annotates some aspect of the object the vCard represents.
     * Cardinality: 1* (original: *)
     */
    protected ?Photo $PHOTO;

    /**
     * To specify the components of the delivery address.
     * Cardinality: 1* (original: *)
     */
    protected ?Address $ADR;

    /**
     * To specify the electronic mail address for communication with the object the vCard represents.
     * Cardinality: 1* (original: *)
     */
    protected ?string $EMAIL;

    /**
     * To specify the position or job of the object the vCard represents.
     * Cardinality: 1* (original: *)
     */
    protected ?string $TITLE;


    /**
     * To specify the organizational name and units associated with the vCard.
     * Cardinality: 1* (original: *)
     */
    protected ?string $ORG;

    public function __construct(
        Name $N,
        string $FN = null,
        Photo $PHOTO = null,
        Address $ADR = null,
        string $EMAIL = null,
        string $TITLE = null,
        string $ORG = null,
    )
    {
        // The version will be locked to 4.0 for now.
        $this->VERSION = '4.0';

        $this->N = $N;
        $this->FN = $FN;
        $this->PHOTO = $PHOTO;
        $this->ADR = $ADR;
        $this->EMAIL = $EMAIL;
        $this->TITLE = $TITLE;
        $this->ORG = $ORG;
    }
}