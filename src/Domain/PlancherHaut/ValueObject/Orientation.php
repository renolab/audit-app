<?php

namespace App\Domain\PlancherHaut\ValueObject;

use App\Domain\Common\Enum\Orientation as EnumOrientation;
use App\Domain\Common\ValueObject\Nombre;

/**
 * Orientation de la paroi en °
 */
final class Orientation extends Nombre
{
    public static function from(float $valeur): static
    {
        return static::_from($valeur, positive: false, min: 0, max: 360);
    }

    public function enum(): EnumOrientation
    {
        return EnumOrientation::from_azimut($this->valeur());
    }
}
