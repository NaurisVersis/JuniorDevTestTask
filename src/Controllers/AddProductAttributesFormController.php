<?php

namespace JuniorDevTestTask\Controllers;

use Doctrine\ORM\EntityManager;
use JuniorDevTestTask\Entities\Category;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class AddProductAttributesFormController
{
    private EntityManager $entityManager;
    private Environment $twig;

    public function __construct(EntityManager $entityManager, Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->twig = $twig;
    }

    public function __invoke(ServerRequestInterface $request, array $args): ResponseInterface
    {
        /** @var Category $category */
        $category = $this
            ->entityManager
            ->getRepository(Category::class)
            ->findOneBy(['id' => $args['categoryId']]);

        return new HtmlResponse(
            $this->twig->render(
                'add-product-attributes.html.twig',
                [
                    'attributes' => $category->getAttributes(),
                ]
            )
        );
    }
}