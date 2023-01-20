<?php

declare(strict_types=1);

namespace JuniorDevTestTask\Controllers;


use Doctrine\ORM\EntityManager;
use JuniorDevTestTask\Entities\Product;
use Laminas\Diactoros\Response\EmptyResponse;
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

        $product = $this
            ->entityManager
            ->getRepository(Product::class)
            ->findOneBy(['sku' => $body['sku']]);

        if ($product !== null) {

            return new EmptyResponse;
        }

        $class =  '\JuniorDevTestTask\Entities\\'.ucwords($body['product_type']);
        $product = new $class($body['sku'], $body['name'], $body['price']);
        $attributeNames = $product::getAttributeNames();
        foreach ($attributeNames as $attributeName) {

            $method = 'set' . ucfirst($attributeName);

            $product->$method(intval($body[$attributeName]));
    }


        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return new RedirectResponse('/');
    }
}
