<?php

$chapter_image = '';
if (isset($_FILES['file'])) {
    $file = $_FILES['file']['name'];
    $max_size = 2000000;
    $size = $_FILES['file']['size'];
    $extensions = array('.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF');
    $extension = strrchr($file, '.');

    if (!in_array($extension, $extensions)) {
        $error = "Cette image n'est pas valable";
    }

    if ($size > $max_size) {
        $error = "Le fichier est trop volumineux";
    }

    if (!isset($error)) {
        $key = $_POST['title'] . time() . $extension;
        move_uploaded_file($_FILES['file']['tmp_name'], 'public/img/' . $key);
        $chapter_image = $key;
    }
}