<?php

namespace CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dessert
 *
 * @ORM\Table(name="dessert")
 * @ORM\Entity(repositoryClass="CantineBundle\Repository\DessertRepository")
 */
class Dessert
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

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
     * @return Dessert
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
}

