<?php

namespace JuniorDevTestTask\Entities;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'products')]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private $id = null;

    #[ORM\Column(type: 'string')]
    private string $sku;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $price;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(name:'category_id', referencedColumnName: 'id')]
    private Category |null $category;

    /**
     * @var Collection<AttributeValue>
     */
    #[ORM\OneToMany(mappedBy: 'product', targetEntity: AttributeValue::class)]
    private Collection $attributeValues;


    public function __construct(
        string $sku,
        string $name,
        string $price,
    ) {
        $this->sku = $sku;
        $this->name = $name;
        $this->price = $price;
        $this->attributeValues = new ArrayCollection();
    }
    public function getId(): int
    {
        return $this->id;
    }
        public function getSku(): string
    {
        return $this->sku;
    }
    public function setSku(string $sku): Product
    {
        $this->sku = $sku;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): string
    {
        return $this->price;
    }


    public function setPrice(string $price): Product
    {
        $this->price = $price;
        return $this;
    }
        public function setCategory(Category $category): void
    {
        $this->category = $category;
    }
        public function getCategory(): Category
    {
        return $this->category;
    }

    public function addAttributeValue(AttributeValue $attributeValue): void
    {
        $this->attributeValues[] = $attributeValue;

        $attributeValue->setProduct($this);
    }
    /**
     * @return Collection<AttributeValue>
     */
    public function getAttributeValues(): Collection
    {
        return $this->attributeValues;
    }

    }