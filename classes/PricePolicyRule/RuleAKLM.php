<?php
namespace PricePolicyRule;
/**
 * This rule is meant to be "A plus one of [K,L,M]", but, in fact, it is
 * a composition of A+K, A+L and A+M rules, so we just use them "as is". But it
 * is not good sometimes, because behaviour of this rules may be changed in time
 * and result of this rule will be different
 * 
 */
class RuleAKLM extends Rule {
    protected $type = Rule::RULE_PRODUCT_SPECIFIC;
    protected $discount = 0.05;
    
    public function meetItems(&$items) {
        $rules = array(
            new RuleAK(),
            new RuleAL(),
            new RuleAM(),
        );
        $discount = 0;
        foreach ( $rules as $rule ) {
            $discount += $rule->meetItems($items);
        }
        return $discount;
    }
}