<?php

namespace Anthony\Blog_Alaska\Model;

require_once("../model/Manager.php");

class Admin extends Manager
{
    protected $id,
        $name,
        $email,
        $password,
        $token,
        $role;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function token()
    {
        return $this->token;
    }

    public function role()
    {
        return $this->role();
    }

    public function is_admin($email,$password)
    {
        global $db;
        $admin = [
            'email'     =>  $email,
            'password'  =>  sha1($password)
        ];
        $sql = "SELECT * FROM admins WHERE email = :email AND password = :password";
        $req = $db->prepare($sql);
        $req->execute($admin);
        $exist = $req->rowCount($sql);
        return $exist;
    }
}
?>