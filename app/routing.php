<?php

use JuniorDevTestTask\Views\ProductsView;


// Controllers explained: https://route.thephpleague.com/5.x/controllers/

/**
 * @var $router League\Route\Router
 */
$router->map('GET', '/', ProductsView::class);