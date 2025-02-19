<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Card
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $title = null;

    #[ORM\Column]
    private ?string $front = null;

    #[ORM\Column]
    private ?string $back = null;

    #[ORM\ManyToOne(inversedBy: 'cards')]
    private ?Deck $deck = null;

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

    public function getFront(): ?string
    {
        return $this->front;
    }

    public function setFront(string $front): self
    {
        $this->front = $front;
        return $this;
    }

    public function getBack(): ?string
    {
        return $this->back;
    }

    public function setBack(string $back): self
    {
        $this->back = $back;
        return $this;
    }

    public function getDeck(): ?Deck
    {
        return $this->deck;
    }

    public function setDeck(Deck $deck): self
    {
        $this->deck = $deck;
        return $this;
    }
}