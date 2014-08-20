<?php
namespace PricePolicy;
class PricePolicyFactory {
    public function getInstance($type) {
        switch( $type ) {
            case 'ComplexPricePolicy':
                return new ComplexPricePolicy();
                break;
            case 'HolidayPricePolicy':
                return new HolidayPricePolicy();
                break;
            case 'SimplePricePolicy':
                return new SimplePricePolicy();
                break;
        }
        throw new Exception('Not supported price policy');
    }
}