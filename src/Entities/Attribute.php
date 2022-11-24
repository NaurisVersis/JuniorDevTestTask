<?php

namespace JuniorDevTestTask\Entities;


use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'attributes')]
class Attribute
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(type: 'string')]
    private string $name;

    #[ORM\Column(type: 'string')]
    private string $unit;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'attributes')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private Category|null $category;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function getUnit(): string
    {
        return $this->unit;
    }


    public function setUnit(string $unit): Attribute
    {
        $this->unit = $unit;
        return $this;
    }


    public function getCategory(): ?Category
    {
        return $this->category;
    }


    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    public function getLowercaseName(): string
    {
        return strtolower($this->name);
    }

}