<?php

namespace Jardiland\ProduitBundle\Entity;
 
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;
 
/**
* @ORM\Entity
* @ORM\Table(name="utilisateur")
*/
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
 
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}