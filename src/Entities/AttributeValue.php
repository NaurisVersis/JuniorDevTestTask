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

    #[ORM\Column(type: 'integer')]
    private int $value;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'attributeValues')]
    #[ORM\JoinColumn(name: 'product_id', referencedColumnName: 'id')]
    private Product |null $product;

    public function __construct( int $value, Attribute $attribute,)
    {
        $this->attribute = $attribute;
        $this->value = $value;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
    public function setValue(int $value): AttributeValue
    {
        $this->value = $value;
        return $this;
    }
    public function getValue(): int
    {
        return $this->value;
    }

    public function getAttribute(): Attribute
    {
        return $this->attribute;
    }
}

