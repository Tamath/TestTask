<?php
namespace PricePolicyRule;
/**
 * Makes discount on total amount of items
 * 
 */
class RuleTotalAmount extends Rule {
    protected $type = Rule::RULE_PRODUCT_SPECIFIC;
    
    public function meetItems(&$items) {
        $totalPrice = 0;
        $totalAmount = 0;
        array_walk($items, function ($value, $key) use (&$totalPrice, &$totalAmount) {
            if ( $key!=\Product\Product::PRODUCT_A && $key!=\Product\Product::PRODUCT_C ) {
                $totalPrice += $value['price']*$value['amount'];
                $totalAmount += $value['amount'];
            }
        });
        if ( $totalAmount>=5 ) {
            return $totalPrice*0.2;
        } elseif ( $totalAmount>=4 ) {
            return $totalPrice*0.1;
        } elseif ( $totalAmount>=3 ) {
            return $totalPrice*0.05;
        } else {
            return 0;
        }
    }
    
}