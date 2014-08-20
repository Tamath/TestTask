<?php
namespace PricePolicyRule;
/**
 * D+E rule
 */
class RuleDE extends Rule {
    protected $type = Rule::RULE_PRODUCT_SPECIFIC;
    protected $productTypes = array(
        \Product\Product::PRODUCT_D,
        \Product\Product::PRODUCT_E,
    );
    protected $discount = 0.05;
}