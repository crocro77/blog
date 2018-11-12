<?php
// tableau de couleur des tables de la bdd pour le dashboard
function inTable($table){
    $db = new PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
    $query = $db->query("SELECT COUNT(id) FROM $table");
    return $nombre = $query->fetch();
}

function getColor($table,$colors){
    if(isset($colors[$table])){
        return $colors[$table];
    }else{
        return "lightblue";
    }
}