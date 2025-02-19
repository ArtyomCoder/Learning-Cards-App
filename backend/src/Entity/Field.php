<?php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
class Field
{
    private ?int $id = null;

    public ?string $title = '';

    public ?string $content = '';

    public ?Note $note = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}