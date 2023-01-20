<?php

namespace JuniorDevTestTask\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'books')]
class Book extends Product
{
    protected string $type = 'Book';

    protected string $unit = 'kg';

    #[ORM\Column(type: 'integer')]
    private int $weight;

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getAttributes(): array
    {
        return [
            'weight' => $this->weight,
        ];
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}