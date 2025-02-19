<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Note
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\OneToMany(targetEntity: Field::class, mappedBy: 'note', cascade: ['persist', 'remove'])]
    private ?Collection $fields = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    private ?Deck $deck = null;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFields(): ?Collection
    {
        return $this->fields;
    }

    public function addCards(Field $field): self
    {
        if (!$this->fields->contains($field)) {
            $this->fields->add($field);
        }
        return $this;
    }

    public function removeFields(Field $field): self
    {
        $this->fields->removeElement($field);
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