<?php

use JuniorDevTestTask\Entities\Category;

require __DIR__ . '/app/bootstrap.php';

/**
 * @var $entityManager Doctrine\ORM\EntityManager
 */

$dvds = new Category('DVD');
$books = new Category('Book');
$furniture = new Category('Furniture');

$dvds->setHint('size');
$books->setHint('weight');
$furniture->setHint('dimensions');

$size = new \JuniorDevTestTask\Entities\Attribute('Size');
$weight = new \JuniorDevTestTask\Entities\Attribute('Weight');
$width = new \JuniorDevTestTask\Entities\Attribute('Width');
$height = new \JuniorDevTestTask\Entities\Attribute('Height');
$length = new \JuniorDevTestTask\Entities\Attribute('Length');

$size->setUnit('MB');
$weight->setUnit('kg');
$width->setUnit('cm');
$height->setUnit('cm');
$length->setUnit('cm');

$dvds->addAttribute($size);
$books->addAttribute($weight);
$furniture->addAttribute($width);
$furniture->addAttribute($height);
$furniture->addAttribute($length);

$entityManager->persist($dvds);
$entityManager->persist($books);
$entityManager->persist($furniture);

$entityManager->persist($size);
$entityManager->persist($weight);
$entityManager->persist($height);
$entityManager->persist($width);
$entityManager->persist($length);

$entityManager->flush();

