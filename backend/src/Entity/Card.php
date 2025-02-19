<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;

class Card
{
    private ?int $id = null;

    public ?string $front = '';

    public ?string $back = '';

    public ?Deck $deck = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}