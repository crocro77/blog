<?php

function post($title,$content,$posted){
    global $db;

    $newPost = [
        'title'     =>  $title,
        'content'   =>  $content,
        'author'    =>  'Jean Forteroche',
        'posted'    =>  $posted

    ];

    $sql = "INSERT INTO posts(title, content, author, date, posted) VALUES(:title, :content, :author, NOW(), :posted)";

    $req = $db->prepare($sql);
    $req->execute($newPost);

}

function post_img($tmp_name, $extension){
    global $db;
    $id = $db->lastInsertId();
    $image = [
        'id'    =>  $id,
        'image' =>  $id.$extension
    ];

    $sql = "UPDATE posts SET chapter_image = :image WHERE id = :id";
    $req = $db->prepare($sql);
    $req->execute($image);
    move_uploaded_file($tmp_name,"../img/posts/".$id.$extension);
    header("Location:index.php?page=post&id=".$id);
}