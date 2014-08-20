<?php
namespace PricePolicyRule;
/**
 * A+B rule
 */
class RuleAB extends Rule {
    protected $type = Rule::RULE_PRODUCT_SPECIFIC;
    protected $productTypes = array(
        \Product\Product::PRODUCT_A,
        \Product\Product::PRODUCT_B,
    );
    protected $discount = 0.1;
}