<?php

namespace App\Database\Local\Chauffage;

use App\Database\Local\{XMLTableElement, XMLTableRepositoryTrait};
use App\Domain\Chauffage\Enum\TypeGenerateur;
use App\Domain\Chauffage\Table\{Combustion, CombustionRepository};

final class XMLCombustionRepository implements CombustionRepository
{
    use XMLTableRepositoryTrait;

    public static function table(): string
    {
        return 'chauffage.generateur.combustion.xml';
    }

    public function find(int $id): ?Combustion
    {
        return ($record = $this->createQuery()->and(\sprintf('@id = "%s"', $id))->getOne()) ? $this->to($record) : null;
    }

    public function find_by(TypeGenerateur $type_generateur, int $annee_installation, ?float $puissance_nominale): ?Combustion
    {
        $record = $this->createQuery()
            ->and(\sprintf('type_generateur_id = "%s"', $type_generateur->id()))
            ->andCompareTo('annee_installation_generateur', $annee_installation)
            ->andCompareTo('puissance_nominale', $puissance_nominale)
            ->getOne();
        return $record ? $this->to($record) : null;
    }

    protected function to(XMLTableElement $record): Combustion
    {
        return new Combustion(
            id: $record->id(),
            rpn: (string) $record->rpn,
            rpint: ($value = $record->rpint) ? (string) $value : null,
            qp0: ($value = $record->qp0) ? (string) $value : null,
            pn_max: ($value = $record->pn_max) ? (float) $value : null,
            pveil: ($value = $record->pveil) ? (float) $value : null,
        );
    }
}
