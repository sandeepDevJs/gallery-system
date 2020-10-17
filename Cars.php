<?php


class Cars{

    static $inc=20;

    function __construct(){
        echo self::$inc++."<br>";
    }


    function __destruct(){
        echo self::$inc--."<br>";
    }

}

$car = new Cars();


?>