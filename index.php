<?php
// init autoloader
include('classes/Autoloader.php');
$autoloader = new Autoloader(__DIR__.'/classes');
$autoloader->register();

/**
 * In real world \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_A) will be substituted by
 * \Product\Product entities retrieved from DB, e.g.:
 * 
 * $products = $database->retrieve('some condition goes here');
 * $cart = new \ShoppingCart();
 * foreach ( $products as $product ) {
 *     $cart->add($product);
 * }
 * 
 * or just implement shopping cart method to accept array of products
 */
$cart = new \ShoppingCart();
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_A), 1);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_B), 2);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_C), 3);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_D), 2);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_E), 2);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_F), 1);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_G), 5);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_H), 7);

$cart->setPricePolicy(\PricePolicy\PricePolicyFactory::getInstance('ComplexPricePolicy'));

echo 'Total: '.$cart->getTotal()."<br>\n";