<?php
/**
 * Helper trait to avoid code duplicates
 * 
 */
trait FactoryTrait {
   
    /**
     * Classes maps
     * array(
     *    'SomeTypeA' => '\\Path\\To\\Class\\A',
     *    'SomeTypeB' => '\\Path\\To\\Class\\B',
     *    ...
     * )
     * 
     * @var array
     */
    protected $classMap = array();
    
    /**
     * Returns class of desired type
     * 
     * @param string $type
     * @return \stdClass
     * @throws \Exception
     */
    public function getInstance($type) {
        if ( isset($this->classMap[$type]) ) { 
            $className = $this->classMap[$type];
            return new $className();
        }
        throw new \Exception('Class of type "'.$type.'" cannot be instantiated.');
    }
    
}