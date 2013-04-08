<?php

namespace Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="users")
 */
class User
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    private $id;
    /**
     * @Column(type="string")
     */
    private $name;
    /**
     * @Column(type="string")
     */
    private $email;
    /**
     * @Column(type="string")
     */
    private $username;
    /**
     * @Column(type="string")
     */
    private $password;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        return $this->name = $name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        return $this->email = $email;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        return $this->username = $username;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        return $this->password = $password;
    }
}