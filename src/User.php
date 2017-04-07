<?php
// src/User.php
/**
 * @Entity @Table(name="user")
 **/
class User
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
    protected $user;
    /** @Column(type="string") **/
    protected $password;

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function checkPassword($hashPass)
    {
        if ($this->password === $hashPass)
        {
            return 0;
        }
        return -1;
    }

    public function setPassword($password)
    {
        $this->password = sha1($password);
    }
}
?>