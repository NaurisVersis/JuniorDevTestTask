<?php

namespace JuniorDevTestTask\Controllers;

use Doctrine\ORM\EntityManager;
use JuniorDevTestTask\Entities\Category;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;


class AddProductFormController
{
    private EntityManager $entityManager;
    private Environment $twig;

    public function __construct(EntityManager $entityManager, Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->twig = $twig;
    }

    public function __invoke(): ResponseInterface
    {
        $categories = $this->entityManager->getRepository(Category::class)->findAll();

        return new HtmlResponse(
            $this->twig->render(
                'add-product.html.twig',
                [
                    'categories' => $categories,
                ]
            )
        );
    }
}
