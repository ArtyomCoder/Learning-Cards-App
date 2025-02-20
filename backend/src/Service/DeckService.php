<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\DeckDto;
use App\Entity\Deck;
use App\Exception\NotFoundException;
use App\Mapper\DeckMapper;
use App\Repository\DeckRepository;

class DeckService
{
    public function __construct(
        private DeckMapper $deckMapper,
        private DeckRepository $deckRepository,
    )
    {
    }

    private function toDto(Deck $deck): DeckDto
    {
        return $this->deckMapper->mapEntityToDto($deck);
    }

    private function save(DeckDto $data, ?Deck $deck = null): Deck
    {
        $result = $this->deckMapper->mapDtoToEntity($data, $deck);
        $this->deckRepository->save($result);
        return $result;
    }

    public function createDeck(DeckDto $data): DeckDto
    {
        $deck = $this->save($data);
        return $this->toDto($deck);
    }

    private function findDeckSafe(int $id): ?Deck
    {
        return $this->deckRepository->find($id);
    }

    private function findDeck(int $id): Deck
    {
        $deck = $this->findDeckSafe($id);
        if ($deck === null) {
            throw new NotFoundException('Deck id="' . $id . 'does not exist');
        }
        return $deck;
    }

    public function getDeck(int $id): ?DeckDto
    {
        $result = null;
        $deck = $this->findDeck($id);
        if ($deck !== null) {
            $result = $this->toDto($deck);
        }
        return $result;
    }
}