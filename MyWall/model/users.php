<?php
class User
{
    // Variables privadas
    private $user;
    private $passwd;

    // Constructor
    public function __construct($user, $passwd)
    {
        $this->user = $user;
        $this->passwd = $passwd;
    }

    // Getters
    public function getUser()
    {
        return $this->user;
    }

    public function getPasswd()
    {
        return $this->passwd;
    }

    // Setters
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function setPasswd($passwd)
    {
        $this->passwd = $passwd;
    }

}
