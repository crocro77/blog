<?php

namespace Anthony\Blog_Alaska\Admin\Model;

require_once("model/Manager.php");

class Admin extends Manager
{
    protected $id,
        $name,
        $email,
        $password;

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

    public function is_admin($email,$password)
    {
        $db = $this->dbConnect();
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