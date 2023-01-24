<?php

namespace JuniorDevTestTask\Controllers;

use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;


class AddProductFormController
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(): ResponseInterface
    {
        return new HtmlResponse(
            $this->twig->render(
                'add-product.html.twig',
            )
        );
    }
}
