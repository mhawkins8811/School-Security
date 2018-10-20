<?php


/**
 * Tokenizer short summary.
 *
 * Tokenizer description.
 *
 * @version 1.0
 * @author Michael Manz
 */

//include 'TokenType.php';
class Tokenizer
{
    private $e= array();//char[]
    private $i;//int i
    // public $currentChar;//char
    static $letters ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_";
    static $digits = "0123456789";

    function __construct($e){//recieves a string

        $this->e=str_split($e);//sends the split string
        $this->i=0;

    }

    function nextToken(){

        //  global $inputString;//created before to be put in the while
      //  echo '<script>console.log("your stuff hereTOKENIZER")</script>' . $s;

     //  $example=strpos($this->e[$this->i],"\r");
     //   $exampleA=strpos($this->e[$this->i],"\n");

   //     $example=strpos($this->e[$this->i],"\r");
     //   $exampleA=strpos($this->e[$this->i],"\n");
        //  echo"HEREE".$example;
        while ( $this->i < count($this->e) && (strpos(" \r\t\n",$this->e[$this->i])!==false)){
       // while ( $this->i < count($this->e) && (($this->e[$this->i]===" ") || (strpos($this->e[$this->i], "\n") !== false) || (strpos($this->e[$this->i], "\r") !== false) )|| (strpos($this->e[$this->i], "\"") !== false) ){
      //      $exampleAA=strpos($this->e[$this->i],"\r");
      //      $exampleAAA=strpos($this->e[$this->i],"\n");
            $this->i++;
        }

        //insert while loop

        if($this->i>=count($this->e)){//bravo

            return new Token(TokenType::EOF);
        }
        $inputString ="";//should go in HERE
        while((($this->i<count($this->e))&&(strpos(self::$digits,$this->e[$this->i])!==false))){//charlie
            $inputString =$inputString. $this->e[$this->i++];//concat again!
        }

        if(!""==$inputString){//dela
            return new Token(TokenType::INT,$inputString);
        }

       // $temp =(strpos(self::$letters, $this->e[$this->i]) != false );
       // $tempA= strpos(self::$letters, $this->e[$this->i]);
       // $tempAA=strpos(self::$letters);

        while ((($this->i < count($this->e)) && (strpos(self::$letters, $this->e[$this->i]) !== false )))
        {
            $inputString =$inputString. $this->e[$this->i++];//concatenating kept messing me up +=
        }

        //insert while loop that check for INT

        if(!""==$inputString){
            if("if"==$inputString){

                return new Token(TokenType::IF);
            }
            if("else"==$inputString){

                return new Token(TokenType::ELSE);
            }
            return new Token(TokenType::ID, $inputString);
        }

        switch($this->e[$this->i++]){//might be here
            case '{':
                // $userObje = Token::Token();

                return new Token(TokenType::LBRACKET,"{");
            case '}':

                return new Token(TokenType::RBRACKET,"}");
            case '[':

                return new Token(TokenType::LSQUAREBRACKET,"[");
            case ']':

                return new Token(TokenType::RSQUAREBRACKET,"]");
            case '<':

                return new Token(TokenType::LESS,"<");
            case '>':

                return new Token(TokenType::GREATER,">");
            case '=':
                return new Token(TokenType::EQUAL,"=");
            case '"':
                $value="";
                while($this->i<count($this->e) && $this->e[$this->i]!='"'){
                    $c=$this->e[$this->i++];
                    if($this->i>=count($this->e)){

                        return new Token(TokenType::OTHER);
                    }
                    if($c=='\\'  && $this->e[$this->i]=='"'){
                        $c='"';
                        $this->i++;
                    }
                   // $value += $c;
                    $value = $value . $c;
                }//end of while loop
                $this->i++;

                return new Token(TokenType::STRING,$value);
            default:

                return new Token(TokenType::OTHER);


        }//switch
    }//end of nextToken
}