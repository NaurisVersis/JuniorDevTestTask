<?php


namespace JuniorDevTestTask\Controllers;


use Doctrine\ORM\EntityManager;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Validation\ValidationException;
use JuniorDevTestTask\Entities\Product;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class CreateProductController
{
    private EntityManager $entityManager;
    private Validator $validator;

    public function __construct(EntityManager $entityManager, Validator $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getParsedBody();

        $errors = [];

        $existingSku = $this->entityManager->getRepository(Product::class)->findOneBy(['sku' => $body['sku']]);

        if ($existingSku) {
            $errors['sku'][] = 'Sku already exists!';
        }

        try {
            $class = '\JuniorDevTestTask\Entities\\' . ucwords($body['product_type']);
            $product = new $class($body, $this->validator);
            $attributeNames = $class::getAttributeNames();

            foreach ($attributeNames as $attributeName) {
                $method = 'set' . ucfirst($attributeName);

                $product->$method(intval($body[$attributeName]));
            }
        } catch (ValidationException $e) {
            $errors = $errors + $e->errors();
        }

        if ($errors) {
            return new JsonResponse($errors, 400);
        }

        $this->entityManager->persist($product);
        $this->entityManager->flush();
        return new EmptyResponse(201);
    }
}
