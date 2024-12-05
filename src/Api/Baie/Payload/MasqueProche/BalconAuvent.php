<?php

namespace App\Api\Baie\Payload\MasqueProche;

use App\Domain\Baie\Enum\TypeMasqueProche;
use Symfony\Component\Validator\Constraints as Assert;

final class BalconAuvent
{
    public function __construct(
        #[Assert\Uuid]
        public string $id,
        public string $description,
        public TypeMasqueProche\BalconAuvent $type,
        #[Assert\Positive]
        public float $avancee,
    ) {}
}