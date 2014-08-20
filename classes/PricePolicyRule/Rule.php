<?php
namespace PricePolicyRule;
/**
 * Abstract class that is describes some discount rule. In this concrete class
 * already implemented functionality to support simple "one item of one type + one
 * item of other type = discount % on this items" rules.
 * 
 */
abstract class Rule {
    const RULE_PRODUCT_SPECIFIC = 1;
    const RULE_ON_ALL_PRODUCTS = 2;
   
    /**
     * Type of rule. See RULE_*
     * 
     * @var int
     */
    protected $type = null;
    
    /**
     * List of product types for built-ib common rule case
     * 
     * @var array
     */
    protected $productTypes = array();
    
    /**
     * Discount amount
     * 
     * @var float
     */
    protected $discount = 0.0;
    
    /**
     * Checks if some items from list are meet conditions.
     * If so, they are removed from list
     * 
     * @param array $items List of items
     *                    array(
     *                        productTypeA => array(
     *                            'price' => priceA,
     *                            'amount' => amountA,
     *                        ),
     *                        ...
     *                    )
     * @return int Discount amount
     */
    public function meetItems(&$items) {
        $discount = 0;
        
        // find out how much items of needed types do we have
        $itemsMetIndividual = array();
        foreach ( $this->productTypes as $productType ) {
            if ( isset($items[$productType]) ) {
                $itemsMetIndividual[$productType] = $items[$productType]['amount'];
            } else {
                $itemsMetIndividual[$productType] = 0;
            }
        }
        
        // discount complete sets
        $itemsMetTotal = min($itemsMetIndividual);
        if ( $itemsMetTotal>0 ) {
            foreach ( $this->productTypes as $productType ) {
                $discount += $items[$productType]['price']*$itemsMetTotal*$this->discount;
                $items[$productType]['amount'] -= $itemsMetTotal;
            }
            return $discount;
        }
        
        return 0;
    }
    
    /**
     * Returns type of rule
     * 
     * @return int
     */
    public function getType() {
        return $this->type;
    }
    
}