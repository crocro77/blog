<?php

class Admin
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
}
?>