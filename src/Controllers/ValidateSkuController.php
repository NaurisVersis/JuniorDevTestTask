<?php

namespace JuniorDevTestTask\Controllers;

use Doctrine\ORM\EntityManager;
use JuniorDevTestTask\Entities\Product;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class ValidateSkuController
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $query = $request->getQueryParams();

        if (!isset($query['sku'])) {
            return new JsonResponse(
                [
                    'error' => 'You should pass "sku" parameter.'
                ],
                400
            );
        }

        /** @var Product $product */
        $product = $this
            ->entityManager
            ->getRepository(Product::class)
            ->findOneBy(['sku' => $query['sku']]);

        if ($product !== null) {
            return new JsonResponse(
                [
                    'error' => sprintf('Product with sku "%s" already exists.', $query['sku'])
                ],
                409
            );
        }

        return new EmptyResponse();
    }
}