<?php

namespace App\Domain\PlancherHaut\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeIsolation: int implements Enum
{
    case INCONNU = 1;
    case NON_ISOLE = 2;
    case ITI = 3;
    case ITE = 4;
    case ITR = 5;
    case ITI_ITE = 6;
    case ITI_ITR = 7;
    case ITE_ITR = 8;
    case ISOLE_TYPE_INCONNU = 9;

    public static function from_enum_type_isolation_id(int $id): self
    {
        return self::from($id);
    }

    /** @return array<self> */
    public static function cases_by_type_plancher_haut(TypePlancherHaut $type_plancher_haut): array
    {
        return match (true) {
            \in_array($type_plancher_haut, [
                TypePlancherHaut::DALLE_BETON,
                TypePlancherHaut::PLAFOND_LOURD,
                TypePlancherHaut::COMBLES_AMENAGES_SOUS_RAMPANT,
                TypePlancherHaut::TOITURE_CHAUME,
                TypePlancherHaut::PLAFOND_PATRE,
                TypePlancherHaut::BAC_ACIER,

            ]) => [
                self::INCONNU,
                self::NON_ISOLE,
                self::ITI,
                self::ITE,
                self::ITI_ITE,
                self::ISOLE_TYPE_INCONNU
            ],
            default => self::cases(),
        };
    }

    public function defaut(int $annee_construction): self
    {
        if (false === $this->inconnu()) {
            return $this;
        }
        if ($this === self::ISOLE_TYPE_INCONNU) {
            return self::ITE;
        }
        if ($annee_construction < 1975) {
            return self::NON_ISOLE;
        }
        return self::ITE;
    }

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::INCONNU => 'Inconnu',
            self::NON_ISOLE => 'Non isolé',
            self::ITI => 'ITI',
            self::ITE => 'ITE',
            self::ITR => 'ITR',
            self::ITI_ITE => 'ITI + ITE',
            self::ITI_ITR => 'ITI + ITR',
            self::ITE_ITR => 'ITE + ITR',
            self::ISOLE_TYPE_INCONNU => 'Isolé mais type d\'isolation inconnu'
        };
    }

    public function inconnu(): bool
    {
        return $this === self::INCONNU || $this === self::ISOLE_TYPE_INCONNU;
    }

    public function est_isole(): ?bool
    {
        return match ($this) {
            self::INCONNU => null,
            self::NON_ISOLE => false,
            default => true
        };
    }
}
