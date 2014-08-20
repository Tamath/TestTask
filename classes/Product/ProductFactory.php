<?php
namespace Product;
/**
 * Factory for products
 * 
 */
class ProductFactory {
    
    /**
     * Returns product of desired type. Whole factory is created in case different
     * classes for different products will be needed
     * 
     * @param string $productType
     * @return \Product\Product
     */
    public static function getInstance($productType) {
        return new Product($productType);
    }
        
}