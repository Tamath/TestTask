<?php
/**
 * PSR-0 compaint autoloader
 * Usage:
 * $autoloader = new Autoloader('/path/to/classes');
 * $autoloader->register();
 */
class Autoloader {
    /**
     * Files path prefix
     * 
     * @var string
     */
    protected $pathPrefix = '';
    
    /**
     * Constructor
     *
     * @var $pathPrefix Files path prefix. No leading slash
     */
    public function __construct($pathPrefix) {
        $this->pathPrefix = $pathPrefix;
    }
    
    /**
     * Registers spl autoloader
     * 
     */
    public function register() {
        spl_autoload_register(array($this,'load'));
    }
    
    /**
     * Loads class. Should not be called statically
     * 
     * @param string $className Fully-qualified class name
     */
    public function load($className) {
        if ( strpos($className, '\\')!==false ) {
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        } else {
            $path = str_replace('_', DIRECTORY_SEPARATOR, $className);
        }
        if ( file_exists($this->pathPrefix.$path) ) {
            include($this->pathPrefix.$path);
        }
    }
    
}