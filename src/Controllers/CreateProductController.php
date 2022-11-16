<?php

declare(strict_types=1);

namespace JuniorDevTestTask\Controllers;

use Doctrine\ORM\EntityManager;
use JuniorDevTestTask\Entities\AttributeValue;
use JuniorDevTestTask\Entities\Category;
use JuniorDevTestTask\Entities\Product;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class CreateProductController
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        /** @var Category $category */
        $category = $this
            ->entityManager
            ->getRepository(Category::class)
            ->findOneBy(['id' => $body['productType']]);

        /** @var Product $product */
        $product = $this
            ->entityManager
            ->getRepository(Product::class)
            ->findOneBy(['sku' =>$body['sku']]);


            $product = new Product($body['sku'], $body['name'], $body['price']);
            $category->addProduct($product);

            foreach ($category->getAttributes() as $attribute) {
                $intValue = (int)$body[$attribute->getLowercaseName()];
                $attributeValue = new AttributeValue($intValue, $attribute);

                $product->addAttributeValue($attributeValue);
                $this->entityManager->persist($attributeValue);
            }

            $this->entityManager->persist($product);
            $this->entityManager->flush();
            return new RedirectResponse('/');







    }
}
