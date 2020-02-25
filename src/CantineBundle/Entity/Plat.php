<?php

namespace CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plat
 *
 * @ORM\Table(name="plat")
 * @ORM\Entity(repositoryClass="CantineBundle\Repository\PlatRepository")
 */
class Plat
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return int
     */
    public function getCalories()
    {
        return $this->calories;
    }

    /**
     * @param int $calories
     */
    public function setCalories($calories)
    {
        $this->calories = $calories;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="calories", type="integer")
     */
    private $calories;

    /**
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param int $likes
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;
    }


   /**
     * @var integer
     *
     * @ORM\Column(name="likes", type="integer")
     */
    private $likes;



   /**
     * @var integer
     *
     * @ORM\Column(name="dislikes", type="integer")
     */
    private $dislikes;

    /**
     * @return int
     */
    public function getDislikes()
    {
        return $this->dislikes;
    }

    /**
     * @param int $dislikes
     */
    public function setDislikes($dislikes)
    {
        $this->dislikes = $dislikes;
    }






    /**
     * @return int
     */
    public function getRes()
    {
        return $this->res;
    }

    /**
     * @param int $res
     */
    public function setRes($res)
    {
        $this->res = $res;
    }

   /**
     * @var integer
     *
     * @ORM\Column(name="res", type="integer")
     */
    private $res;



    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Plat
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Plat
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    public function __toString() {
        return $this->libelle;
    }
}

