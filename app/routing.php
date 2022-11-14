<?php

use JuniorDevTestTask\Controllers\AddProductAttributesFormController;
use JuniorDevTestTask\Controllers\AddProductFormController;
use JuniorDevTestTask\Controllers\CreateProductController;
use JuniorDevTestTask\Views\ProductsView;


// Controllers explained: https://route.thephpleague.com/5.x/controllers/

/**
 * @var $router League\Route\Router
 */
$router->map('GET', '/', ProductsView::class);
$router->map('GET', '/add-product', AddProductFormController::class);
$router->map('GET', '/add-product-attributes/{categoryId}', AddProductAttributesFormController::class);
$router->map('POST', '/create-product', CreateProductController::class);