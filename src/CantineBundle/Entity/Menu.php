<?php

namespace CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Menu
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="CantineBundle\Repository\MenuRepository")
 * @ORM\Table(name="menu",uniqueConstraints={@ORM\UniqueConstraint(name="pk", columns={"jour","semaine"})})
 * @UniqueEntity(fields={"jour","semaine"}, message="Jour déja rempli")

 */
class Menu
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
     * @var integer
     *
     * @ORM\Column(name="calories", type="integer" ,nullable=true)
     */
    private $calories;

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
     * @return mixed
     */
    public function getPlat()
    {
        return $this->plat;
    }

    /**
     * @param mixed $plat
     */
    public function setPlat($plat)
    {
        $this->plat = $plat;
    }

    /**
     * @return mixed
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param mixed $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="Semaine")
     * @ORM\JoinColumn(name="semaine",referencedColumnName="id",onDelete="CASCADE")
     */
    private $semaine;

    /**
     * @return mixed
     */
    public function getDessert()
    {
        return $this->dessert;
    }

    /**
     * @param mixed $dessert
     */
    public function setDessert($dessert)
    {
        $this->dessert = $dessert;
    }



    /**
     *
     * @ORM\ManyToOne(targetEntity="Plat")
     * @ORM\JoinColumn(name="plat",referencedColumnName="id",onDelete="CASCADE")
     */
    private $plat;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Dessert")
     * @ORM\JoinColumn(name="dessert",referencedColumnName="id")
     */
    private $dessert;

    /**
     * @return mixed
     */
    public function getSemaine()
    {
        return $this->semaine;
    }

    /**
     * @param mixed $semaine
     */
    public function setSemaine($semaine)
    {
        $this->semaine = $semaine;
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="Jourdelasemaine")
     * @ORM\JoinColumn(name="jour",referencedColumnName="id")
     */
    private $jour;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

