<?php

namespace CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Semaine
 *
 * @ORM\Table(name="semaine")
 * @ORM\Entity(repositoryClass="CantineBundle\Repository\SemaineRepository")
 */
class Semaine
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
     * @var \Date
     *
     * @ORM\Column(name="debut", type="date")
     */
    private $debut;

    /**
     * @return string
     */
    public function getSemaine()
    {
        return $this->semaine;
    }

    /**
     * @param string $semaine
     */
    public function setSemaine($semaine)
    {
        $this->semaine = $semaine;
    }

    /**
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
 /**
     * @var \string
     * @ORM\Column(name="libelle", type="string")
     */
    private $libelle;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fin", type="date")
     */
    private $fin;


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
     * Set debut
     *
     * @param \Date $debut
     *
     * @return Semaine
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut
     *
     * @return \Date
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set fin
     *
     * @param \Date $fin
     *
     * @return Semaine
     */
    public function setFin($fin)
    {
        $this->fin = $fin;

        return $this;
    }

    /**
     * Get fin
     *
     * @return \Date
     */
    public function getFin()
    {
        return $this->fin;
    }
}

