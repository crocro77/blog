<?php

namespace Anthony\Blog_Alaska\Admin\Model;

require_once("model/Manager.php");

class Dashboard extends Manager
{
    public function inTable($table)
    {
        $db = $this->dbConnect();
        $query = $db->query("SELECT COUNT(id) FROM $table");
        return $nombre = $query->fetch();
    }

    public function getColor($table, $colors)
    {
        if (isset($colors[$table])) {
            return $colors[$table];
        } else {
            return "lightblue";
        }
    }

    public function get_comments()
    {
        $db = $this->dbConnect();
        $req = $db->query("SELECT comments.id, comments.author, comments.email, comments.comment_date, comments.post_id, comments.comment, posts.title FROM comments JOIN posts ON comments.post_id = posts.id WHERE comments.seen = '0' ORDER BY comments.comment_date ASC");
        $results = [];
        while ($rows = $req->fetchObject()) {
            $results[] = $rows;
        }
        return $results;
    }

    public function edit_comment($comment_edited, $id)
    {
        $db = $this->dbConnect();
        $commentEdition = [
            'comment' => $comment_edited,
            'id' => $id
        ];
        $sql = "UPDATE comments SET comment=:comment, date=NOW() WHERE id=:id";
        $req = $db->prepare($sql);
        $req->execute($commentEdition);
    }
}