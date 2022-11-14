<?php

namespace JuniorDevTestTask\Entities;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'attribute_values')]
class AttributeValue
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(targetEntity: Attribute::class)]
    #[ORM\JoinColumn(name: 'attribute_id', referencedColumnName: 'id')]
    private Attribute $attribute;

    #[ORM\Column(type: 'string')]
    private string $value;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'attributeValues')]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product |null $product;

    public function __construct( string $value, Attribute $attribute,)
    {
        $this->attribute = $attribute;
        $this->value = $value;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
    public function setValue(string $value): AttributeValue
    {
        $this->value = $value;
        return $this;
    }
    public function getValue(): string
    {
        return $this->value;
    }

    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }
}

