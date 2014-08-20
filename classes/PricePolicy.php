<?php
/**
 * Class describes set of rules that is to be applied to retrieve total price.
 * Each rule represent discount on some conditions
 */
class PricePolicy {
    
    /**
     * Set of rules
     * 
     * @var array
     */
    protected $rules = array();
    
    /**
     * Total price
     * 
     * @var int
     */
    protected $total = null;
    
    /**
     * Add rule to policy
     * 
     * @param \PricePolicyRule\Rule $rule
     */
    public function addRule(\PricePolicyRule\Rule $rule) {
        $this->rules[] = $rule;
    }
    
    /**
     * Returns total price. If $forceRecalculate is FALSE and total is calculated before,
     * just returns cached value
     * 
     * @param array $list List of items
     *                    array(
     *                        productTypeA => array(
     *                            'price' => priceA,
     *                            'amount' => amountA,
     *                        ),
     *                        ...
     *                    )
     * @param bool $forceRecalculate
     * @return int
     */
    public function getTotal(array $list, $forceRecalculate=false) {
        if ( $this->total!==null && $forceRecalculate==false ) {
            return $this->total;
        }
        
        $total = 0;
        // calculate prices sum
        array_walk($list, function ($value) use (&$total) {
            $total += $value['price']*$value['amount'];
        });
        // apply rules in exact order
        $listOriginal = $list;
        foreach ( array(\PricePolicyRule\Rule::RULE_PRODUCT_SPECIFIC, \PricePolicyRule\Rule::RULE_ON_ALL_PRODUCTS) as $ruleType ) {
            foreach ( $this->rules as $rule ) {
                if ( $rule->getType()!=$ruleType ) {
                    continue;
                }
                $total -= $rule->meetItems($list);
            }
            $list = $listOriginal; // reset list every rule type change
        }
        
        $this->total = $total;
        return $total;
        
    }
}