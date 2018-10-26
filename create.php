<?php

    extract($_POST);
    $sql ="INSERT into posts (title, content) VALUES ('','','$title','$content','')";
    header("Location: index.php");