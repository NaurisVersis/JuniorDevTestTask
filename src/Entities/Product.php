<?php

namespace JuniorDevTestTask\Entities;


use Doctrine\ORM\Mapping as ORM;
use Illuminate\Contracts\Validation\Factory as Validator;


#[ORM\Entity]
#[ORM\Table(name: 'products')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['book' => Book::class, 'dvd' => Dvd::class, 'furniture' => Furniture::class])]
abstract class Product
{
    protected string $type;

    protected static string $unit;

    protected static string $description;

    private array $baseRules = [
        'sku' => 'required|string',
        'name' => 'required|string',
        'price' => 'required|string',
    ];

    // Should be filled per product
    protected static array $attributeRules = [];

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $sku;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $price;

    public function __construct(
        array $productData,
        Validator $validator,
    ) {
        $productFields = $this->baseRules + static::$attributeRules;

        $validator->validate($productData, $productFields);
        $this->sku = $productData['sku'];
        $this->name = $productData['name'];
        $this->price = $productData['price'];
    }
    abstract public function getAttributes(): array;

    public static function getAttributeNames(): array
    {
        return array_keys(static::$attributeRules);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public static function getDescription(): string
    {
        return self::$description;
    }
}