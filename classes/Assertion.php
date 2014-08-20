<?php
/**
 * Handy interface to built-in assert function
 * 
 */
class Assertion {
    
    /**
     * Asserts $assertion. Prints OK message on success, fail message otherwise
     * 
     * @param mixed $assertion
     * @param string $description
     */
    public function assert($assertion, $description=null) {
        assert_options(ASSERT_WARNING, 0);
        if (assert($assertion) ) {
            echo 'Assertion ok: '.$description.'<br>'.PHP_EOL;
        } else {
            echo 'Assertion fail: '.$description.'<br>'.PHP_EOL;
        }
    }
}