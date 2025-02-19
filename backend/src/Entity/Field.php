<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ApiResource]
class Field
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private ?int $id = null;

    #[ORM\Column]
    public string $title = '';

    #[ORM\Column(type: 'text')]
    public string $content = '';

    #[ORM\ManyToOne(inversedBy: 'fields')]
    public ?Note $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}