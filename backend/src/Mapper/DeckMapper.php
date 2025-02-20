<?php

declare(strict_types=1);

namespace App\Mapper;

use App\Dto\DeckDto;
use App\Entity\Deck;
use App\Repository\DeckRepository;

class DeckMapper {
    public function __construct(
        private DeckRepository $deckRepository
    ) {
    }

    public function mapDtoToEntity(DeckDto $dto, ?Deck $entity = null): Deck
    {
        $result = $entity ?: new Deck();
        if ($dto->title !== null) {
            $result->setTitle($dto->title);
        }
        if ($dto->description !== null) {
            $result->setDescription($dto->description);
        }
        return $result;
    }

    public function mapEntityToDto(Deck $entity): DeckDto
    {
        $result = new DeckDto();
        $result->title = $entity->getTitle();
        $result->description = $entity->getDescription();
        return $result;
    }
}