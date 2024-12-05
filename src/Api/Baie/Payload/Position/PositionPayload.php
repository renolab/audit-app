<?php

namespace App\Api\Baie\Payload\Position;

use App\Domain\Baie\Enum\Mitoyennete;
use App\Domain\Baie\ValueObject\Position;
use App\Services\Validator\Constraints as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;

final class PositionPayload
{
    public function __construct(
        #[Assert\NotEqualTo(Mitoyennete::LOCAL_NON_CHAUFFE)]
        public Mitoyennete $mitoyennete,
        #[AppAssert\Orientation]
        public ?float $orientation,
    ) {}

    public function to(): Position
    {
        return Position::create(
            mitoyennete: $this->mitoyennete,
            orientation: $this->orientation,
        );
    }
}
