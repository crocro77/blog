<?php

namespace Anthony\BlogAlaska\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function get_posts()
    {
        $db = $this->db_connect();
        $req = $db->query("SELECT id, title, content, author, chapter_image, DATE_FORMAT(date, '%d/%m/%Y à %Hh%i') AS creation_date_fr FROM posts ORDER BY id LIMIT 0, 5");
        $results = array();
        while($rows = $req->fetchObject()){
            $results[] = $rows;
        }
        return $results;
    }

    public function get_post()
    {
        $db = $this->db_connect();
        $req = $db->query("SELECT id, title, chapter_image, content, author, DATE_FORMAT(date, '%d/%m/%Y à %Hh%i') AS creation_date_fr FROM posts WHERE id='{$_GET['id']}' AND posted = '1'");
        $result = $req->fetchObject();
        return $result;
    }

    function get_chapters()
    {
        $db = $this->db_connect();    
        $req = $db->query("SELECT * FROM posts ORDER BY id");    
        $results = [];
        while($rows = $req->fetchObject()){
            $results[] = $rows;
        }
        return $results;
    }

}