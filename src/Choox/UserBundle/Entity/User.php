<?php
/**
 * Created by PhpStorm.
 * User: msoliman
 * Date: 02.04.2016
 * Time: 10:15
 */

namespace Choox\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 * Class User
 * @package Choox\UserBundle\Entity
 */
class User extends \FOS\UserBundle\Model\User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $favouriteTeam;

    /**
     * @ORM\Column(type="integer")
     */
    protected $points = 0;


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getFavouriteTeam()
    {
        return $this->favouriteTeam;
    }

    /**
     * @param mixed $favouriteTeam
     */
    public function setFavouriteTeam($favouriteTeam)
    {
        $this->favouriteTeam = $favouriteTeam;
    }

    
    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param mixed $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }



}