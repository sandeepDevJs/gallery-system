<?php


    require_once("init.php");
    if(isset($_POST['image_name'])){
        $user = new User;
        $user->ajax_save($_POST['image_name'], $_POST['user_id']);
    }

?>