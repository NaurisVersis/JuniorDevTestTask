<?php
declare(strict_types=1);

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
        $classname = '\JuniorDevTestTask\Entities\\'.ucwords($args['type']);
        $attributeNames = $classname::getAttributeNames();



        return new HtmlResponse(
            $this->twig->render(
                'add-product-type.html.twig',
                [
                    'attributeNames' => $attributeNames
                ]
            )
        );
    }
}