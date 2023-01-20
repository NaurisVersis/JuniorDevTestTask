<?php

use JuniorDevTestTask\Controllers\AddProductFormController;
use JuniorDevTestTask\Controllers\AddProductTypeFieldsController;
use JuniorDevTestTask\Controllers\CreateProductController;
use JuniorDevTestTask\Controllers\DeleteProductsController;
use JuniorDevTestTask\Controllers\ProductsViewController;
use JuniorDevTestTask\Controllers\ValidateSkuController;


/**
 * @var $router League\Route\Router
 */
$router->map('GET', '/', ProductsViewController::class);
$router->map('GET', '/add-product', AddProductFormController::class);
$router->map('GET', '/add-product-type-fields/{type}', AddProductTypeFieldsController::class);
$router->map('POST', '/create-product', CreateProductController::class);
$router->map('GET', '/validate-product-sku', ValidateSkuController::class);
$router->map('POST', '/delete-products', DeleteProductsController::class);