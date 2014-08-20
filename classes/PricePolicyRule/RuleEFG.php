<?php
namespace PricePolicyRule;
/**
 * E+F+G rule
 */
class RuleEFG extends Rule {
    protected $type = Rule::RULE_PRODUCT_SPECIFIC;
    protected $productTypes = array(
        \Product\Product::PRODUCT_E,
        \Product\Product::PRODUCT_F,
        \Product\Product::PRODUCT_G,
    );
    protected $discount = 0.05;
}