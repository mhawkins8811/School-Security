<?php

/**
 * EvalSectionException short summary.
 *
 * EvalSectionException description.
 *
 * @version 1.0
 * @author Michael Manz
 */
class EvalSectionException extends Exception{
    function exception_handler($m){
        $error= "\nParsing or execution Exception: " . $m . "\n";
        return $error;
    }

}














