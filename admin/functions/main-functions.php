<?php

    session_start();

    $dbhost = 'localhost';
    $dbname = 'blog_alaska';
    $dbuser = 'root';
    $dbpass = '';

    try {
        $db = new PDO('mysql:host='.$dbhost.';dbname='.$dbname,$dbuser,$dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    } catch (PDOException $e) {
        die("Une erreur est survenue lors de la connexion à la base de données.");
    }