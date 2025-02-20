<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use App\Config\DeckConfig;
use App\Dto\DeckDto;
use App\State\DeckCreateProcessor;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new Post(
            name: 'deck_create',
            processor: DeckCreateProcessor::class,
            normalizationContext: ['groups' => [DeckConfig::OUTPUT]],
            denormalizationContext: ['groups' => [DeckConfig::INPUT]],
            openapi: new Operation(summary: '', description: '')
        ),
    ]
)]
class Deck
{
    public array $decks = [];

    #[Groups([
        DeckConfig::INPUT,
        DeckConfig::OUTPUT,
    ])]
    public ?DeckDto $deck = null;
}