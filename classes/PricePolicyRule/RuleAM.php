<?php
namespace PricePolicyRule;
/**
 * A+M rule
 */
class RuleAM extends Rule {
    protected $type = Rule::RULE_PRODUCT_SPECIFIC;
    protected $productTypes = array(
        \Product\Product::PRODUCT_A,
        \Product\Product::PRODUCT_M,
    );
    protected $discount = 0.05;
}