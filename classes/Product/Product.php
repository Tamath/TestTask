<?php
namespace Product;
/**
 * This class represents all products. In real-life situation we will
 * receive product type and price from DB, but, in our case, to simlify everything,
 * we will just use list of prices hardcoded inside and receive type as a parameter
 * while instantiating the class.
 * 
 * Usage:
 * $product = new \Product\Product(\Product\Product::PRODUCT_A);
 */
class Product {
    const PRODUCT_A = 'ProductA';
    const PRODUCT_B = 'ProductB';
    const PRODUCT_C = 'ProductC';
    const PRODUCT_D = 'ProductD';
    const PRODUCT_E = 'ProductE';
    const PRODUCT_F = 'ProductF';
    const PRODUCT_G = 'ProductG';
    const PRODUCT_H = 'ProductH';
    const PRODUCT_I = 'ProductI';
    const PRODUCT_J = 'ProductJ';
    const PRODUCT_K = 'ProductK';
    const PRODUCT_L = 'ProductL';
    const PRODUCT_M = 'ProductM';
    
    /**
     * List of hardcoded prices
     * 
     * @var array
     */
    public $prices = array(
        Product::PRODUCT_A => 10,
        Product::PRODUCT_B => 12,
        Product::PRODUCT_C => 20,
        Product::PRODUCT_D => 14,
        Product::PRODUCT_E => 30,
        Product::PRODUCT_F => 1,
        Product::PRODUCT_G => 9,
        Product::PRODUCT_H => 4,
        Product::PRODUCT_I => 54,
        Product::PRODUCT_J => 45,
        Product::PRODUCT_K => 11,
        Product::PRODUCT_L => 22,
        Product::PRODUCT_M => 92,
    );
    
    /**
     * Price of the item
     * 
     * @var int
     */
    protected $price = 0;
    
    /**
     * Type of the item. Equals to one of PRODUCT_* constants
     * 
     * @var string
     */
    protected $type = null;
    
    /**
     * Constructor
     * 
     * @param string $type One of the PRODUCT_* constants
     * @throws \Exception In case $type provided is not found in prices list
     */
    public function __construct($type) {
        $this->type = $type;
        if ( isset($this->prices[$type]) ) {
            $this->price = $this->prices[$type];
        } else {
            throw new \Exception('Product "'.$type.'" is not supported');
        }
    }
    
    /**
     * Returns type of product - one of PRODUCT_* constants
     * 
     * @return string
     */
    public function getType() {
        return $this->type;
    }
    
    /**
     * Returns price of the product
     * 
     * @return int
     */
    public function getPrice() {
        return $this->price;
    }
}