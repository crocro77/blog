<?php

namespace Anthony\BlogAlaska\Model;

require_once("Model/Manager.php");

class CommentManager extends Manager
{
    public function get_comments()
    {
        $db = $this->db_connect();    
        $req = $db->query("SELECT * FROM comments WHERE post_id= '{$_GET['id']}' ORDER BY comment_date DESC");
        $results = [];
        while($rows = $req->fetchObject()){
            $results[] = $rows;
        }
        return $results;
    }

    public function post_comment($name,$email,$comment)
    {
        $db = $this->db_connect();    
        $commentaire = array(
            'author'        => $name,
            'email'         => $email,
            'comment'       => $comment,
            'post_id'       => $_GET['id']
    
        );
        $req = $db->prepare("INSERT INTO comments(author, email, comment, post_id, comment_date) VALUES(:author, :email, :comment, :post_id, NOW())");
        $req->execute($commentaire);
    }

}