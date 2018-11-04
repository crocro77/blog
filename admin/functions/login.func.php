<?php

function is_admin($email,$password)
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
