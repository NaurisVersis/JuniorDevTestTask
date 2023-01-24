<?php

use JuniorDevTestTask\Controllers\AddProductFormController;
use JuniorDevTestTask\Controllers\AddProductTypeFieldsController;
use JuniorDevTestTask\Controllers\CreateProductController;
use JuniorDevTestTask\Controllers\DeleteProductsController;
use JuniorDevTestTask\Controllers\ProductsViewController;

$router->map('GET', '/', ProductsViewController::class);
$router->map('GET', '/add-product', AddProductFormController::class);
$router->map('GET', '/add-product-type/{type}', AddProductTypeFieldsController::class);
$router->map('POST', '/create-product', CreateProductController::class);
$router->map('POST', '/delete-products', DeleteProductsController::class);