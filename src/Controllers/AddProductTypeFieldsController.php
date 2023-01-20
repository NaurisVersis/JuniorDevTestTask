<?php

namespace JuniorDevTestTask\Controllers;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class AddProductTypeFieldsController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(ServerRequestInterface $request, array $args): ResponseInterface
    {
        return new HtmlResponse(
            $this->twig->render(
                'add-product-type-fields.html.twig',
                [
                    'type' => $args['type'],
                ]
            )
        );
    }
}