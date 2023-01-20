<?php

declare(strict_types=1);

namespace JuniorDevTestTask\Controllers;

use Doctrine\ORM\EntityManager;
use JuniorDevTestTask\Entities\{Book, Dvd, Furniture, Product};
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Laminas\Diactoros\Response\TextResponse;
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

        switch ($body['product_type']) {
            case 'book':
                $product = new Book($body['sku'], $body['name'], $body['price']);
                $product->setWeight(intval($body['weight']));
                break;
            case 'dvd':
                $product = new Dvd($body['sku'], $body['name'], $body['price']);
                $product->setSize(intval($body['size']));
                break;
            case 'furniture':
                $product = new Furniture($body['sku'], $body['name'], $body['price']);
                $product->setHeight(intval($body['height']));
                $product->setLength(intval($body['length']));
                $product->setWidth(intval($body['width']));
                break;
        }


        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return new RedirectResponse('/');
    }
}
