<?php

namespace Anthony\Blogalaska\Model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf8', 'root', '');
        return $db;
    }
}