<?php
function loc_now_admin(){
    $url = $_SERVER["HTTP_HOST"];
    if (empty($_SERVER["REQUEST_SCHEME"])){
        $ssl = "http://";
    }else{
        $ssl = $_SERVER["REQUEST_SCHEME"]."://";
    }
    $run = $ssl.$url."/admin/login";
    return $run;
}

session_start();
session_destroy();
$_SESSION["login"] = false;
header("LOcation: ".loc_now_admin()); die();
?>