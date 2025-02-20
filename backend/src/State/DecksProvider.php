<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Deck;
use App\Service\DeckService;

class DecksProvider implements ProviderInterface
{
    public function __construct(
        private DeckService $deckService
    )
    {
        
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Deck
    {
        $result = new Deck();
        $result->decks = $this->deckService->getDecks();
        return $result;
    }
}