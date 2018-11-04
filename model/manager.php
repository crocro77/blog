<?php

namespace Anthony\BlogAlaska\Model;

class Manager
{
    protected function db_connect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog_alaska;charset=utf-8', 'root', '');
        return $db;
    }
}