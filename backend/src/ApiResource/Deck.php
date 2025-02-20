<?php

declare(strict_types=1);

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Link;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Parameter;
use App\Config\DeckConfig;
use App\Dto\DeckDto;
use App\State\DeckCreateProcessor;
use App\State\DeckProvider;
use App\State\DecksProvider;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\PropertyInfo\Type;

#[ApiResource(
    operations: [
        new Post(
            name: 'deck_create',
            processor: DeckCreateProcessor::class,
            normalizationContext: ['groups' => [DeckConfig::OUTPUT]],
            denormalizationContext: ['groups' => [DeckConfig::INPUT]],
            validationContext: [
                'groups' => [
                    DeckConfig::VALID_CREATE,
                    DeckConfig::VALID,
                ],
            ],
            openapi: new Operation(summary: '', description: ''),
        ),
        new Get(
            name: 'deck_get',
            uriTemplate: '/decks/{id}',
            uriVariables: [
                'id' => new Link(
                    fromClass: DeckDto::class,
                    fromProperty: 'id'
                )
            ],
            provider: DeckProvider::class,
            normalizationContext: ['groups' => [DeckConfig::OUTPUT]],
            openapi: new Operation(
                summary: '', 
                description: '',
                parameters: [
                    new Parameter(
                        name: 'id',
                        in: 'path',
                        required: true,
                        schema: ['type' => 'integer']
                    )
                ]
            )
        ),
        new Get(
            name: 'deck_list',
            provider: DecksProvider::class,
            normalizationContext: ['groups' => [DeckConfig::OUTPUT_LIST]],
            openapi: new Operation(
                summary: '', 
                description: '',
            )
        ),
    ]
)]
class Deck
{
    #[ApiProperty(
        builtinTypes: [
            new Type(
                builtinType: Type::BUILTIN_TYPE_ARRAY,
                collection: true,
                collectionValueType: [
                    new Type(
                        builtinType: Type::BUILTIN_TYPE_OBJECT,
                        class: DeckDto::class,
                    )
                ]
            )
        ]
    )]
    #[Groups([DeckConfig::OUTPUT_LIST])]
    public array $decks = [];

    #[Groups([
        DeckConfig::INPUT,
        DeckConfig::OUTPUT,
    ])]
    public ?DeckDto $deck = null;
}