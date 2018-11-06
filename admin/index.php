<?php

require("../controller/Controller.php");

$pages = scandir('view/');
if(isset($_GET['view']) && !empty($_GET['view'])){
    if(in_array($_GET['view'].'.php',$pages)){
        $page = $_GET['view'];
    }else{
        $page = "error";
    }
}else{
    $page = "dashboard";
}

$pages_functions = scandir('model/');
if(in_array($page.'.func.php',$pages_functions)){
    include 'model/'.$page.'.func.php';
}

?>