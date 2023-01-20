<?php

namespace JuniorDevTestTask\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'furniture')]
class Furniture extends Product
{
    protected string $type = 'Furniture';

    protected string $unit = 'cm';

    #[ORM\Column(type: 'integer')]
    private int $width;

    #[ORM\Column(type: 'integer')]
    private int $height;

    #[ORM\Column(type: 'integer')]
    private int $length;

    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    public function getAttributes(): array
    {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
        ];
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

}