<?php

declare(strict_types=1);

namespace App\Dto;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Config\DeckConfig;

class DeckDto
{
    #[ApiProperty(identifier: true)]
    #[Groups([
        DeckConfig::OUTPUT,
        DeckConfig::OUTPUT_LIST,
    ])]
    public ?int $id = null;

    #[Groups([
        DeckConfig::INPUT,
        DeckConfig::OUTPUT,
        DeckConfig::OUTPUT_LIST,
    ])]
    public ?string $title = null;

    #[Groups([
        DeckConfig::INPUT,
        DeckConfig::OUTPUT,
        DeckConfig::OUTPUT_LIST,
    ])]
    public ?string $description = null;
}