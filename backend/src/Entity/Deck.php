<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource]
class Deck
{
    private ?int $id = null;

    public ?string $title = '';

    public ?string $description = '';

    public iterable $notes;

    public iterable $cards;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}