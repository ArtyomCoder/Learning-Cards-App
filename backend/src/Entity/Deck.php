<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Deck
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $title = null;

    #[ORM\Column]
    private ?string $description = null;

    #[ORM\OneToMany(targetEntity: Card::class, mappedBy: 'deck', cascade: ['persist', 'remove'])]
    private ?Collection $cards = null;

    public function __construct()
    {
        $this->cards = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCards(): ?Collection
    {
        return $this->cards;
    }

    public function addCards(Card $card): self
    {
        if (!$this->cards->contains($card)) {
            $this->cards->add($card);
        }
        return $this;
    }

    public function removeCards(Card $card): self
    {
        $this->cards->removeElement($card);
        return $this;
    }
}