<?php





/**
 * Token short summary.
 *
 * Token description.
 *
 * @version 1.0
 * @author Michael Manz
 */


//$type->LBRACKET;
//$type = new TokenType();
//$type;//the use of object
//$TokeType = new TokenType();


class Token
{
    var $type;
    var $value;


    public function __construct (){
        $argv = func_get_args();
        switch( func_num_args()){
            case 1:
                self::__Token1($argv[0]);
                break;
            case 2:
                self::__Token2($argv[0],$argv[1]);
                break;
        }
    }

    public function __Token1($theType){
        $this->type = $theType;
        $this->value = "";
    }
    public function __Token2($theType,$theValue){
        $this->type=$theType;
        $this->value=$theValue;
    }
    function printToken(){
        switch($this->type){

            case LBRACKET:
                return "LBRACKET";
            case RBRACKET:
                return "RBRACKET";
            case LSQUAREBRACKET:
                return "LSQUAREBRACKET";
            case RSQUAREBRACKET:
                return "RSQUAREBRACKET";
            case LESS:
                return "LESS";
            case GREATER:
                return "REATER";
            case EQUAL:
                return "EQUAL";
            case ID:
                return "ID "+$this->value;
            case INT:
                return "INT "+$this->value;
            case "IF":
                return "IF";
            case "ELSE":
                return "ELSE";
            case STRING:
                return "STRING "+$this->value;
            default:
                return "OTHER";

        }
    }

        // $this->value= $theValue=77;//77 hasn't been used random number



}//end class










