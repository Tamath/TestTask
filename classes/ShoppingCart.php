<?php
class ShoppingCart {
    protected $list = array();
    protected $pricePolicy = null;
    
    public function __construct() {
        $this->list = new \SplObjectStorage();
    }
    
    public function setPricePolicy() {
        
    }
    
    public function  add(\Product\Product $product, $amount=1) {
        if ( isset($this->list[$product]) ) {
            $this->list[$product] += $amount;
        } else {
            $this->list[$product] = $amount;
        }
    }
    
    public function getTotal() {
        
    }
}