<?php

namespace App\Domain\Lnc\Entity;

use App\Domain\Common\Type\Id;
use App\Domain\Lnc\Lnc;
use App\Domain\Lnc\Enum\{EtatIsolation, Mitoyennete, TypeBaie, TypeLnc};
use App\Domain\Lnc\Service\{MoteurEnsoleillement, MoteurSurfaceDeperditive};
use App\Domain\Lnc\ValueObject\{EnsoleillementBaieCollection, Menuiserie, Position};
use Webmozart\Assert\Assert;

final class Baie
{
    private ?float $aiu = null;
    private ?float $aue = null;
    private ?EnsoleillementBaieCollection $ensoleillement = null;

    public function __construct(
        private readonly Id $id,
        private readonly Lnc $local_non_chauffe,
        private string $description,
        private Position $position,
        private TypeBaie $type,
        private float $surface,
        private float $inclinaison,
        private ?Menuiserie $menuiserie = null,
    ) {}

    public static function create(
        Id $id,
        Lnc $local_non_chauffe,
        string $description,
        Position $position,
        TypeBaie $type,
        float $surface,
        float $inclinaison,
        ?Menuiserie $menuiserie = null,
    ): self {
        if ($type->is_fenetre()) {
            Assert::notNull($menuiserie);
        }
        if ($position->paroi_id) {
            Assert::notNull($local_non_chauffe->parois()->find($position->paroi_id));
        }
        Assert::greaterThan($surface, 0);
        Assert::greaterThanEq($inclinaison, 0);
        Assert::lessThanEq($inclinaison, 90);

        return new self(
            id: $id,
            local_non_chauffe: $local_non_chauffe,
            description: $description,
            position: $position,
            type: $type,
            surface: $surface,
            inclinaison: $inclinaison,
            menuiserie: $type->is_fenetre() ? $menuiserie : null,
        );
    }

    public function controle(): void
    {
        if ($this->type->is_fenetre) {
            Assert::notNull($this->menuiserie);
        }
        if ($this->position->paroi_id) {
            Assert::notNull($this->local_non_chauffe->parois()->find($this->position->paroi_id));
        }
        Assert::greaterThan($this->surface, 0);
        Assert::greaterThanEq($this->inclinaison, 0);
        Assert::lessThanEq($this->inclinaison, 90);
    }

    public function reinitialise(): void
    {
        $this->aiu = null;
        $this->aue = null;
        $this->ensoleillement = null;
    }

    public function calcule_surface_deperditive(MoteurSurfaceDeperditive $moteur): self
    {
        $this->aue = $moteur->calcule_aue_baie($this);
        $this->aiu = $moteur->calcule_aiu_baie($this);
        return $this;
    }

    public function calcule_ensoleillement(MoteurEnsoleillement $moteur): self
    {
        $this->ensoleillement = $moteur->calcule_ensoleillement_baie($this);
        return $this;
    }

    public function id(): Id
    {
        return $this->id;
    }

    public function local_non_chauffe(): Lnc
    {
        return $this->local_non_chauffe;
    }

    public function paroi(): ?Paroi
    {
        return $this->position->paroi_id
            ? $this->local_non_chauffe->parois()->find($this->position->paroi_id)
            : null;
    }

    public function type_lnc(): TypeLnc
    {
        return $this->local_non_chauffe->type();
    }

    public function position(): Position
    {
        return $this->position;
    }

    public function mitoyennete(): Mitoyennete
    {
        return $this->position->mitoyennete ?? $this->paroi()->mitoyennete();
    }

    public function type(): TypeBaie
    {
        return $this->type;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function surface(): float
    {
        return $this->surface;
    }

    public function inclinaison(): float
    {
        return $this->inclinaison;
    }

    public function menuiserie(): ?Menuiserie
    {
        return $this->menuiserie;
    }

    public function etat_isolation(): EtatIsolation
    {
        return $this->menuiserie?->etat_isolation() ?? EtatIsolation::NON_ISOLE;
    }

    public function ensoleillement(): ?EnsoleillementBaieCollection
    {
        return $this->ensoleillement;
    }

    public function aiu(): ?float
    {
        return $this->aiu;
    }

    public function aue(): ?float
    {
        return $this->aue;
    }
}
