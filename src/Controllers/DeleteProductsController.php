<?php

namespace JuniorDevTestTask\Controllers;

use Doctrine\ORM\EntityManager;
use JuniorDevTestTask\Entities\Product;
use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeleteProductsController
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $productIds = $request->getParsedBody()['product_ids'] ?? [];

        $queryBuilder
            ->delete(Product::class, 'p')
            ->where('p.id IN (:productIds)')
            ->setParameter('productIds', $productIds)
            ->getQuery()
            ->execute();

        return new EmptyResponse();
    }

}