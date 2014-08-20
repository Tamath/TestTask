<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// init autoloader
include('classes/Autoloader.php');
$autoloader = new Autoloader(__DIR__.'/classes/');
$autoloader->register();

/**
 * In real world \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_A)
 * will be substituted by \Product\Product entities retrieved from DB, e.g.:
 * 
 * $products = $database->retrieve('some condition goes here');
 * $cart = new \ShoppingCart();
 * foreach ( $products as $product ) {
 *     $cart->add($product);
 * }
 * 
 * or implement shopping cart method to accept array of products
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
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_I), 5);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_J), 7);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_K), 6);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_L), 12);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_M), 15);
$cart->add(\Product\ProductFactory::getInstance(\Product\Product::PRODUCT_A), 17);

/**
 * In real world this rules could be retrieved from database or other source. For example,
 * we know that our policy is "Complex", then:
 * 
 * $pricePolicy = $database->retrieve('condition to retrieve "Complex" price policy');
 * 
 * and rules are already loaded (lazy-loaded, may be) using relations or we can add
 * them explicitly:
 * 
 * $rules = $database->retrieve('condition to retrieve rules');
 * foreach ( $rules as $rule ) {
 *    $pricePolicy->addRule($rule);
 * }
 * 
 * But in this case we will define rules in classes
 */
$pricePolicy = new \PricePolicy();
$pricePolicy->addRule(new \PricePolicyRule\RuleAB());
$pricePolicy->addRule(new \PricePolicyRule\RuleDE());
$pricePolicy->addRule(new \PricePolicyRule\RuleEFG());
$pricePolicy->addRule(new \PricePolicyRule\RuleAKLM());
$pricePolicy->addRule(new \PricePolicyRule\RuleTotalAmount());
$cart->setPricePolicy($pricePolicy);

echo 'Total: '.$cart->getTotal()."<br>\n";