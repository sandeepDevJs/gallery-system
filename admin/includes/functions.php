<?php

    function classAutoLoader($class){
        $class = strtolower($class);
        $file_path = "includes/{$class}.php";
        if(file_exists($file_path)){
            require_once($file_path);
        }else{
            die("{$class}.php not found!!!!");
        }
    }

    spl_autoload_register("classAutoLoader");

    function redirect($location){
        header("Location: {$location}");
    }
    

?>