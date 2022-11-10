<?php


declare(strict_types=1);

use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;

class ProductController
{
    public function __invoke(): ResponseInterface
    {
        return new JsonResponse(
            [
                'say' => 'Hello world!',
            ]
        );
    }
}