<?php
namespace PricePolicyRule;
/**
 * A+L rule
 */
class RuleAL extends Rule {
    protected $type = Rule::RULE_PRODUCT_SPECIFIC;
    protected $productTypes = array(
        \Product\Product::PRODUCT_A,
        \Product\Product::PRODUCT_L,
    );
    protected $discount = 0.05;
}