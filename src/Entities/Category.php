<?php

namespace JuniorDevTestTask\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'categories')]

class Category
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private $id = null;

    #[ORM\Column]
    private string $name;

    /**
     * @var Collection<Product>
     */
    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Product::class)]
    private Collection $products;

    /**
     * @var Collection<Attribute>
     */

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Attribute::class)]
    private Collection $attributes;

    public function __construct(string $name)
    {
        $this->name = $name;

        $this->products = new ArrayCollection();
        $this->attributes = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function addAttribute(Attribute $attribute): void
    {
        $this->attributes[] = $attribute;

        $attribute->setCategory($this);
    }
    /**
     * @return Collection<Attribute>
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;

        $product->setCategory($this);
    }
}
