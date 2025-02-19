<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class Card
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column]
    public string $title = '';

    #[ORM\Column]
    public string $front = '';

    #[ORM\Column]
    public string $back = '';

    #[ORM\ManyToOne(inversedBy: 'cards')]
    public ?Deck $deck = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}