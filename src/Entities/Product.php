<?php

namespace JuniorDevTestTask\Entities;


use Doctrine\ORM\Mapping as ORM;



#[ORM\Entity]
#[ORM\Table(name: 'products')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['book' => Book::class, 'dvd' => Dvd::class, 'furniture' => Furniture::class])]
abstract class Product
{
    protected string $type;

    protected string $unit;

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
        string $sku,
        string $name,
        string $price,
    ) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
    }

    abstract public function getAttributes(): array;

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
}