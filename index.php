
<?php

//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);//
//error_reporting(E_ALL);

//echo '<script>console.log("your stuff here")</script>';
require_once( 'Token.php');
require_once( 'Tokenizer.php');
require_once( 'TokenType.php');
require_once( 'EvalSectionException.php');
(new Fall18Prog()) -> start();

class Fall18Prog{

    static $currentToken ;//token
    static $t ;//tokenizer
    static $map= array();//this is going to be an array since hashmaps are not in php
    static $oneIndent = "   ";//three spaces
    static $result;





    static function start(){
        echo<<<_END
        <html>
          <head>\n
            <title>CS 4339/5339 PHP assignment</title>\n
          </head>\n
          <body>\n
             <pre>
_END;
        try{
            $programsUrl = "http://localhost/wa1/fall18Testing.txt";
            $sequence = " ";
            $inp  = fopen($programsUrl, 'r');
            $sequence = file_get_contents($programsUrl);
            $section =0;
            self::$t = new Tokenizer($sequence);
            self::$currentToken = self::$t->nextToken();
            while(self::$currentToken->type != TokenType::EOF){

              //  $inputLine = fgets($inp);

               // echo $sequence . "zzzzzzzzzzzzzzzzzzzzz\n";
                try {




                    //

                    try {

                        echo "\n section ". ++$section."\n";
                        self::evalSection();
                        echo "\n section Result ". self::$result ."\n";
                        //  if (self::$currentToken->type !== TokenType::EOF) {
                        //    echo "Unexpected characters at the end of the program:" . self::$currentToken->type ."\n";
                         //   throw new Exception();
                      //  }

                    }
                    catch (EvalSectionException $ex) {
                    //    echo $ex->ese($ex);
                      //  $ex->getMessage();
                        while(self::$currentToken->type !== TokenType::RSQUAREBRACKET && self::$currentToken->type !== TokenType::EOF){
                            self::$currentToken = self::$t->nextToken();


                        }
                        self::$currentToken = self::$t->nextToken();

                    }
                }
                finally {
                }
            }//
        }
        finally
        {}

        echo <<<_END
           </pre>
           </body>
         </html>
_END;
    }
    //print_r "Hello Framework!";

     static function evalSection(){
        //map stuff
        self::$map=array();
        self::$result = "";
        if(self::$currentToken->type != TokenType::LSQUAREBRACKET){
            throw new EvalSectionException("A section must start with \"[\"");
        }
        echo "["."\n";
        self::$currentToken = self::$t->nextToken();
        while(self::$currentToken-> type != TokenType::RSQUAREBRACKET
            && self::$currentToken->type != TokenType::EOF){
            self::evalStatement(self::$oneIndent,true);
        }
        echo "]"."\n";
        self::$currentToken = self::$t->nextToken();
    }


     static function evalStatement($indent,$exec){//throws exception here

         $temp = self::$currentToken->type;
         $tempA = TokenType::STRING;
       //  echo $temp."zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz".$tempA;
        switch(self::$currentToken->type){
            case TokenType::ID;//self::$currentToken->ID:
                self::evalAssigment($indent,$exec);
                break;
            case TokenType::IF;//self::$currentToken->IF:
                self::evalConditional($indent,$exec);
                break;
            case TokenType::STRING;//self::$currentToken->STRING:
                if($exec){
                    self::$result =self::$result. self::$currentToken->value . "\n";

                }
                echo $indent . " \"" . self::$currentToken->value . "\"";
                self::$currentToken = self::$t->nextToken();
                break;
            default:
                throw new EvalSectionException("invalid statement");
        }
    }

     static function evalAssigment($indent,$exec){
        $key = self::$currentToken->value;
        echo $indent . $key;
        self::$currentToken = self::$t->nextToken();
        if(self::$currentToken->type !== TokenType::EQUAL){
            echo "\nParsing or execution Exception: " . "equal sign expected" . " \n";
            throw new EvalSectionException("equal sign expected");
        }
        echo "=";
        self::$currentToken = self::$t->nextToken();//after the a=
        if(self::$currentToken->type !== TokenType::INT){
            echo "\nParsing or execution Exception: " . "integer expected" . " \n";
            throw new EvalSectionException("integer expected");
        }
        $value = self::$currentToken->value;
        echo $value;
        self::$currentToken = self::$t->nextToken();
        if($exec){
            self::$map[$key]= $value;
        }

    }

     static function evalConditional($indent, $exec){
         echo"\n". $indent . "if "."\n";
        self::$currentToken = self::$t->nextToken();
        $trueCondition = self::evalCondition($exec);

        if(self::$currentToken->type != TokenType::LBRACKET){//0
           // echo"\n left bracket expected \n";
            echo "\nParsing or execution Exception: " . "left bracket expected" . "\n";
            throw new EvalSectionException("left bracket expected");
        }
        echo " {"."\n";
        self::$currentToken = self::$t->nextToken();
        while(self::$currentToken->type != TokenType::RBRACKET
            && self::$currentToken->type != TokenType::EOF){

            if($trueCondition){
                self::evalStatement($indent . self::$oneIndent, $exec);//changed from .+
            }
            else{
                self::evalStatement($indent . self::$oneIndent, false);
            }
        }
        if(self::$currentToken->type == TokenType::RBRACKET){
            echo $indent . "}"."\n";
            self::$currentToken = self::$t->nextToken();
        }
        if(self::$currentToken->type == TokenType::ELSE){//3
            echo $indent . "else"."\n";
            self::$currentToken = self::$t->nextToken();
            if(self::$currentToken->type !== TokenType::LBRACKET){
                echo "\nParsing or execution Exception: " . "left bracket expected" . "\n";
                throw new EvalSectionException("left bracket expected");
            }
            echo " {"."\n";
            self::$currentToken = self::$t->nextToken();
            while(self::$currentToken->type != TokenType::RBRACKET
            && self::$currentToken->type != TokenType::EOF){

                if($trueCondition){
                    self::evalStatement($indent . self::$oneIndent, $exec);//changed from .+
                }
                else{
                    self::evalStatement($indent . self::$oneIndent, false);
                }
            }
            if(self::$currentToken->type == TokenType::RBRACKET){
                echo $indent . "}"."\n";
                self::$currentToken = self::$t->nextToken();
            }
        }
    }
     static function evalCondition($exec){//receives a boolean//4
      //$this->currentToken = $currentToken;
        $v1=null;

        if(self::$currentToken->type != TokenType::ID){//0
            echo "\nParsing or execution Exception: " . "identifier expected " . "\n";
            throw new EvalSectionException("identifier expected");

        }
        $key = self::$currentToken->value;
        echo $key;
        if($exec){//1
            $v1 = self::$map[$key];//
            if($v1 == null){
                //cho"undefined variable";
                echo "\nParsing or execution Exception: " . " undefined variable " . "\n";
                //set_exception_handler('undefined variable');
                throw new EvalSectionException('undefined variable');
              //  throw new EvalSectionException("undefined variable");
            }
        }
        self::$currentToken = self::$t->nextToken();
        $operator =self::$currentToken->type;
        //$operator = ;
        if(self::$currentToken->type != TokenType::EQUAL
            && self::$currentToken->type != TokenType::LESS
            && self::$currentToken->type != TokenType::GREATER
            ){//2
            echo "\nParsing or execution Exception: " . "comparison operator expected" . "\n";
            throw new EvalSectionException("comparison operator expected");
        }
        self::$currentToken = self::$t->nextToken();

        if(self::$currentToken->type != TokenType::INT){
            echo "\nParsing or execution Exception: " . "integer expected" . "\n";
            throw new EvalSectionException("integer expected");
        }


        $value=self::$currentToken->value;
        echo $value . " ";
        self::$currentToken = self::$t->nextToken();

        if(!$exec){
            return false;}
        $trueResult = false;
        switch($operator){
            case TokenType::LESS:
                $trueResult = $v1 < $value;
                break;
            case TokenType::GREATER:
                $trueResult = $v1 > $value;
                break;
            case TokenType::EQUAL:
                $trueResult = $v1 = $value;
                break;
        }
        return $trueResult;
    }
}//end of class









