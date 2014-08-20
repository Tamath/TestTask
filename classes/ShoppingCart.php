<?php
/**
 * Shopping cart class. Stores products and returns total price
 * 
 */
class ShoppingCart {
    /**
     * array(
     *     ...
     *     ProductTypeA => array(
     *         'amount' => amountA,
     *         'price' => priceA,
     *     ),
     *     ProductTypeB => array(
     *         'amount' => amountB,
     *         'price' => priceB,
     *     ),
     *     ...
     * )
     * 
     * @var array
     */
    protected $list = array();
    
    /**
     * Pricing policy that is used to determine total amount
     * 
     * @var \PricePolicy
     */
    protected $pricePolicy = null;
        
    /**
     * Sets pricing policy
     * 
     * @param \PricePolicy $pricePolicy
     */
    public function setPricePolicy(\PricePolicy $pricePolicy) {
       $this->pricePolicy = $pricePolicy; 
    }
    
    /**
     * Adds product to cart
     * 
     * @param \Product\Product $product
     * @param int $amount
     */
    public function  add(\Product\Product $product, $amount=1) {
        if ( isset($this->list[$product->getType()]) ) {
            $this->list[$product->getType()]['amount'] += $amount;
        } else {
            $this->list[$product->getType()] = array(
                'amount' => $amount,
                'price' => $product->getPrice(),
            );
        }
        $this->objects[] = $product;
    }

    /**
     * Returns total price for all items, including discounts from pricing policy
     * 
     * @param bool $forceRecalculate Force total recalculate. Otherwise it will be returned from cache
     * @return int|null Returns NULL if no price policy is set, total price otherwise
     */
    public function getTotal($forceRecalculate=false) {
        if ( $this->pricePolicy ) {
            return $this->pricePolicy->getTotal($this->list, $forceRecalculate);
        } else {
            return null;
        }
    }
}