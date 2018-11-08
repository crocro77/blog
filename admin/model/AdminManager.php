<?php

namespace Anthony\Blog_Alaska\Admin\Model;

require_once("Manager.php");

class AdminManager extends Manager
{
    public function is_admin($email,$password)
    {
        $db = $this->dbConnect();

        $admin = [
            'email' => $email,
            'password' => sha1($password)
        ];
        $sql = "SELECT * FROM admins WHERE email = :email AND password = :password";
        $req = $db->prepare($sql);
        $req->execute($admin);
        $exist = $req->rowCount($sql);
        return $exist;
    }
}