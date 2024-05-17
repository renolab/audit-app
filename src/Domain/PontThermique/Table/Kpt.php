<?php

namespace App\Domain\PontThermique\Table;

use App\Domain\Common\Table\TableValue;

/**
 * Valeur forfaitaire de pont thermique
 */
class Kpt implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $kpt)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function valeur(): float
    {
        return $this->kpt;
    }
}
