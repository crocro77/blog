<?php

namespace Anthony\Blog_Alaska\Admin\Model;

require_once("Manager.php");

class DashboardManager extends Manager
{
    public function inTable($table)
    {
        $db = $this->dbConnect();

        $query = $db->query("SELECT COUNT(id) FROM $table");
        return $nombre = $query->fetch();
    }

    public function getColor($table,$colors)
    {
        if(isset($colors[$table])){
            return $colors[$table];
        }else{
            return "lightblue";
        }
    }
	
}