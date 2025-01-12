<?php

namespace App\Domain\Production\Entity;

use App\Domain\Common\Type\Id;
use App\Domain\Production\Production;
use App\Domain\Production\Service\MoteurProduction;
use App\Domain\Production\ValueObject\ProductionPhotovoltaiqueCollection;
use App\Domain\Simulation\Simulation;
use Webmozart\Assert\Assert;

final class PanneauPhotovoltaique
{
    private ?ProductionPhotovoltaiqueCollection $productions = null;

    public function __construct(
        private readonly Id $id,
        private readonly Production $production,
        private float $orientation,
        private float $inclinaison,
        private int $modules,
        private ?float $surface_capteurs,
    ) {}

    public static function create(
        Id $id,
        Production $production,
        float $orientation,
        float $inclinaison,
        int $modules,
        ?float $surface_capteurs,
    ): self {
        Assert::greaterThan($modules, 0);
        Assert::greaterThanEq($orientation, 0);
        Assert::lessThan($orientation, 360);
        Assert::greaterThanEq($inclinaison, 0);
        Assert::lessThanEq($inclinaison, 90);
        Assert::nullOrGreaterThan($surface_capteurs, 0);

        return new self(
            id: $id,
            production: $production,
            orientation: $orientation,
            inclinaison: $inclinaison,
            modules: $modules,
            surface_capteurs: $surface_capteurs,
        );
    }

    public function controle(): void
    {
        Assert::greaterThan($this->modules, 0);
        Assert::greaterThanEq($this->orientation, 0);
        Assert::lessThan($this->orientation, 360);
        Assert::greaterThanEq($this->inclinaison, 0);
        Assert::lessThanEq($this->inclinaison, 90);
        Assert::nullOrGreaterThan($this->surface_capteurs, 0);
    }

    public function reinitialise(): void
    {
        $this->productions = null;
    }

    public function calcule_production(MoteurProduction $moteur, Simulation $simulation): self
    {
        $this->productions = $moteur->calcule_production_photovoltaique($this, $simulation);
        return $this;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function production(): Production
    {
        return $this->production;
    }

    public function inclinaison(): float
    {
        return $this->inclinaison;
    }

    public function orientation(): float
    {
        return $this->orientation;
    }

    public function modules(): int
    {
        return $this->modules;
    }

    public function surface_capteurs(): ?float
    {
        return $this->surface_capteurs;
    }

    public function productions(): ?ProductionPhotovoltaiqueCollection
    {
        return $this->productions;
    }
}
