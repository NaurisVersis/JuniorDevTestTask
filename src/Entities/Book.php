<?php

namespace JuniorDevTestTask\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'books')]
class Book extends Product
{
    protected string $type = 'Book';

    protected static string $unit = 'kg';

    protected static string $description = 'Please, provide size in kg';

    protected static array $attributeRules = [
        'weight' => 'required|integer'
    ];

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
    public static function getUnit(): string
    {
        return self::$unit;
    }
    public static function getDescription(): string
    {
        return self::$description;
    }
}