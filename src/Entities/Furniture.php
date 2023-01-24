<?php

namespace JuniorDevTestTask\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'furniture')]
class Furniture extends Product
{
    protected string $type = 'Furniture';

    protected static string $unit = 'cm';

    protected static string $description = 'Please, provide dimensions in HxWxL format';

    protected static array $attributeRules = [
        'width' => 'required|integer',
        'height' => 'required|integer',
        'length' => 'required|integer',
    ];

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
            'dimensions' => $this->width . 'x' . $this->height . 'x' . $this->length
        ];
    }
    public static function getUnit(): string
    {
        return self::$unit;
    }
    public static function getDescription(): string
    {
        return self::$description;
    }
}