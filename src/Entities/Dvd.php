<?php

namespace JuniorDevTestTask\Entities;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'dvds')]
class Dvd extends Product
{
    protected string $type = 'DVD';

    protected string $unit = 'MB';

    #[ORM\Column(type: 'integer')]
    private int $size;

    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    public function getAttributes(): array
    {
        return [
            'size' => $this->size,
        ];
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}