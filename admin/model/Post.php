<?php

namespace Anthony\Blog_Alaska\Admin\Model;

require_once("model/Manager.php");

class Post extends Manager
{

    public function get_posts()
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT * FROM posts ORDER BY date DESC");
        $results = [];
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }
        return $results;
    }

    public function get_post()
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT id, title, chapter_image, date, content, posted, author FROM posts WHERE id = '{$_GET['id']}'");
        $result = $req->fetchObject();
        return $result;
    }

    public function edit($title, $content, $posted, $id)
    {
        $db = $this->dbConnect();
        $edition = [
            'title' => $title,
            'content' => $content,
            'posted' => $posted,
            'id' => $id
        ];
        $sql = "UPDATE posts SET title=:title, content=:content, date=NOW(), posted=:posted WHERE id=:id";
        $req = $db->prepare($sql);
        $req->execute($edition);
    }

    public function post($title,$content,$posted)
    {
        $db = $this->dbConnect();
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
    
    public function post_img($tmp_name, $extension){
        $db = $this->dbConnect();
        $id = $db->lastInsertId();
        $image = [
            'id'    =>  $id,
            'image' =>  $id.$extension
        ];
        $sql = "UPDATE posts SET chapter_image = :image WHERE id = :id";
        $req = $db->prepare($sql);
        $req->execute($image);
        move_uploaded_file($tmp_name,"../public/img/".$id.$extension);
        header("Location:index.php?page=post&id=".$id);
    }
}