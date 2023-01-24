<?php

namespace JuniorDevTestTask\Entities;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'dvds')]
class Dvd extends Product
{
    protected string $type = 'DVD';

    protected static string $unit = 'MB';

    protected static string $description = 'Please, provide size in MB';

    protected static array $attributeRules = [
        'size' => 'required|integer'
    ];

    #[ORM\Column(type: 'integer')]
    protected int $size;

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

    public static function getUnit(): string
    {
        return self::$unit;
    }
    public static function getDescription(): string
    {
        return self::$description;
    }
}