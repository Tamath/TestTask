<?php
/*******
 * Config & init section
 *******/

error_reporting(E_ALL);
ini_set('display_errors', 1);

// init autoloader
include('classes/Autoloader.php');
$autoloader = new Autoloader(__DIR__.'/classes/');
$autoloader->register();

// init assertion handler
$assertion = new Assertion();

// init products
$products = array();
$products['A'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_A);
$products['B'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_B);
$products['C'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_C);
$products['D'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_D);
$products['E'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_E);
$products['F'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_F);
$products['G'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_G);
$products['H'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_H);
$products['I'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_I);
$products['J'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_J);
$products['K'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_K);
$products['L'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_L);
$products['M'] = \Product\ProductFactory::getInstance(\Product\Product::PRODUCT_M);


/********
 * Tests section
 ********/

$cart = new ShoppingCart();
$totalPrice = 0;
foreach ( $products as $product ) {
    $cart->add($product, 1);
    $totalPrice += $product->getPrice();
}

// no rules at all
$pricePolicyNoRules = new PricePolicy();
$cart->setPricePolicy($pricePolicyNoRules);
$assertion->assert($cart->getTotal()==$totalPrice, 'Price policy without any rules');

// just discount on total amount of items
$pricePolicyTotalRule = new PricePolicy();
$pricePolicyTotalRule->addRule(new \PricePolicyRule\RuleTotalAmount());
$cart->setPricePolicy($pricePolicyTotalRule);
// when not round-ed, values can be not equal even if visually they are the same
// did not done any research on it, but may be result of floating point numbers
// precision
$assertion->assert(
    round($cart->getTotal(), 2)
        ==
    round(
        $products['A']->getPrice()
        +$products['C']->getPrice()
        +($totalPrice-$products['A']->getPrice()-$products['C']->getPrice())*0.8,
        2
    ),
    'Price policy with total amount rule'
);

// check few single specific rules
$pricePolicyABRule = new PricePolicy();
$pricePolicyABRule->addRule(new \PricePolicyRule\RuleAB());
$cart->setPricePolicy($pricePolicyABRule);
$assertion->assert($cart->getTotal()==$totalPrice-($products['A']->getPrice()+$products['B']->getPrice())*0.1, 'Price policy for A+B');

$pricePolicyEFGRule = new PricePolicy();
$pricePolicyEFGRule->addRule(new \PricePolicyRule\RuleEFG());
$cart->setPricePolicy($pricePolicyEFGRule);
$assertion->assert($cart->getTotal()==$totalPrice-($products['E']->getPrice()+$products['F']->getPrice()+$products['G']->getPrice())*0.05, 'Price policy for E+F+G');

// check two single specific pairs
$cart->add($products['A']);
$cart->add($products['B']);
$cart->setPricePolicy($pricePolicyABRule);
// total needs to be recalculated because we are using same policy but with different set of products. obviously todo:
// @TODO: reset cached total when cart is changed
$assertion->assert($cart->getTotal(true)==($totalPrice+$products['A']->getPrice()+$products['B']->getPrice())-2*($products['A']->getPrice()+$products['B']->getPrice())*0.1, 'Price policy for double A+B');