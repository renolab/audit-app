<?php

namespace App\Api\Lnc\Payload;

use App\Domain\Lnc\Enum\TypeLnc;
use Symfony\Component\Validator\Constraints as Assert;

final class LncPayload
{
    public function __construct(
        #[Assert\Uuid]
        public string $id,
        public string $description,
        public TypeLnc $type,
        /** @var ParoiPayload[] */
        #[Assert\All([new Assert\Type(ParoiPayload::class)])]
        #[Assert\Valid]
        public array $parois,
        /** @var (BaiePolycarbonatePayload|FenetrePayload)[] */
        #[Assert\All([new Assert\Type([BaiePolycarbonatePayload::class, FenetrePayload::class])])]
        #[Assert\Valid]
        public array $baies,
    ) {}
}