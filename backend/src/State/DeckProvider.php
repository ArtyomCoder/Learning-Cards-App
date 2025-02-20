<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Deck;
use App\Service\DeckService;

class DeckProvider implements ProviderInterface
{
    public function __construct(
        private DeckService $deckService
    )
    {
        
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ?Deck
    {
        $result = null;
        $deck = $this->deckService->getDeck($uriVariables['id']);
        if ($deck !== null) {
            $result = new Deck();
            $result->deck = $deck;
        }
        return $result;
    }
}