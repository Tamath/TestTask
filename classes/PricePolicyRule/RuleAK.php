<?php
namespace PricePolicyRule;
/**
 * A+K rule
 */
class RuleAK extends Rule {
    protected $type = Rule::RULE_PRODUCT_SPECIFIC;
    protected $productTypes = array(
        \Product\Product::PRODUCT_A,
        \Product\Product::PRODUCT_K,
    );
    protected $discount = 0.05;
}