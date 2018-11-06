<?php

function get_post(){

    global $db;

    $req = $db->query("SELECT id, title, chapter_image, date, content, posted, author FROM posts WHERE id = '{$_GET['id']}'");

    $result = $req->fetchObject();
    return $result;
}

function edit($title,$content,$posted,$id){

    global $db;

    $edition = [
        'title'     => $title,
        'content'   => $content,
        'posted'    => $posted,
        'id'        => $id
    ];

    $sql = "UPDATE posts SET title=:title, content=:content, date=NOW(), posted=:posted WHERE id=:id";
    $req = $db->prepare($sql);
    $req->execute($edition);

}