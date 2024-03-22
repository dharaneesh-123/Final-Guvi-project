<?php
require "../predis/autoload.php";
require '../vendor/autoload.php';

try{
    Predis\Autoloader::register();
    $redis = new Predis\Client();
    
    $redis->set("id","$ecre1");
    $redis->expire("id",3600);
    // if(!$redis->get("id")){
    //     echo "Logout";
    // }
    $con = mysqli_connect("localhost:3307", "root", "root", "users");

    $email = $_POST["email"];
    $updatedpass = $_POST["updatedpass"];

    $result = mysqli_query($con,"UPDATE useraccount SET password='$updatedpass' WHERE email='$email'");
    
    if($result){
        echo "success";
        die();
    }
    echo "error";
    
}


catch(Exception $e){
    die($e->getMessage());
}
      
?>
