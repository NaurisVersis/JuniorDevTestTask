<?php

namespace JuniorDevTestTask\Views;

use Doctrine\ORM\EntityManager;
use JuniorDevTestTask\Entities\Product;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;


class ProductsView
{

    private EntityManager $entityManager;
    private  Environment $twig;

    public function __construct(EntityManager $entityManager, Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->twig = $twig;
    }

    public function __invoke(): ResponseInterface
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        return new HtmlResponse(
            $this->twig->render(
                'index.html.twig',
                [
                    'products' => $products,
                ]
            )
        );
    }
}