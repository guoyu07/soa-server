<?php
namespace model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity @Table(name="users")
 */
class User
{
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    public $id;
    /**
     * @Column(type="string")
     */
    public $name;
    /**
     * @Column(type="string")
     */
    public $email;
}