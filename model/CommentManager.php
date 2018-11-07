<?php

namespace Anthony\Blog_Alaska\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT * FROM comments WHERE post_id= '{$_GET['id']}' ORDER BY comment_date DESC");
        $comments = [];
        while($rows = $req->fetchObject()){
            $comments[] = $rows;
        }
        return $comments;
    }

    public function comment($name,$email,$comment)
    {
        $db = $this->dbConnect();
        $comment = array(
            'author'        => $name,
            'email'         => $email,
            'comment'       => $comment,
            'post_id'       => $_GET['id']
        );
        $req = $db->prepare("INSERT INTO comments(author, email, comment, post_id, comment_date) VALUES(:author, :email, :comment, :post_id, NOW())");
        $req->execute($comment);
    }
}