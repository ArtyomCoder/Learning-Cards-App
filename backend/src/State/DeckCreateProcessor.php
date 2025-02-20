<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\Deck;
use App\Service\DeckService;

class DeckCreateProcessor implements ProcessorInterface
{
    public function __construct(
        private DeckService $deckService
    )
    {
        
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $result = new Deck();
        if ($data->deck !== null) {
            $result->deck = $this->deckService->createDeck($data->deck);
        }
        return $result;
    }
}