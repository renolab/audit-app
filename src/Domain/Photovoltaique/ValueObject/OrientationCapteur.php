<?php

namespace App\Domain\Photovoltaique\ValueObject;

use App\Domain\Common\Enum\Orientation;
use App\Domain\Common\ValueObject\Nombre;

/**
 * Orientation du capteur en azmut
 */
final class OrientationCapteur extends Nombre
{
    public static function from(float $valeur): static
    {
        return static::_from($valeur, positive: false, min: 0, max: 360);
    }

    public function enum(): Orientation
    {
        return Orientation::from_azimut($this->valeur());
    }
}
