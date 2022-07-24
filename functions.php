<?php 

function dump($var){

    echo '<pre>';
     print_r($var);
   echo '<pre/>';
}

function tokken($length){

    $alphabet= "123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    
    return substr(str_shuffle(str_repeat($alphabet,$length)),0,$length) ;

}