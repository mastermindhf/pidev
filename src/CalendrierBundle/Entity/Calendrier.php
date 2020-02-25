<?php

namespace CalendrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Calendrier
 *
 * @ORM\Table(name="calendrier",uniqueConstraints={@ORM\UniqueConstraint(name="pk", columns={"jour", "heure","classe"})})
 * @ORM\Table(name="calendrier",uniqueConstraints={@ORM\UniqueConstraint(name="pk2", columns={"jour", "heure","prof"})})
 * @ORM\Entity(repositoryClass="CalendrierBundle\Repository\CalendrierRepository")

 * @UniqueEntity(fields={"jour","heure","classe"}, message="cette classe est déja occupée")
 * @UniqueEntity(fields={"jour","heure","prof"}, message="prof ocuupé")

 */
class Calendrier
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     *
     * @ORM\ManyToOne(targetEntity="Jour")
     * @ORM\JoinColumn(name="jour",referencedColumnName="id")
     */
    private $jour;


    /**
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="prof",referencedColumnName="id")
     */
    private $prof;

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
     * @return mixed
     */
    public function getProf()
    {
        return $this->prof;
    }

    /**
     * @param mixed $prof
     */
    public function setProf($prof)
    {
        $this->prof = $prof;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }



    /**
     *
     * @ORM\ManyToOne(targetEntity="Heure")
     * @ORM\JoinColumn(name="heure",referencedColumnName="id")
     */
    private $heure;



    /**
     *
     * @ORM\ManyToOne(targetEntity="SuiviBundle\Entity\Classe")
     * @ORM\JoinColumn(name="classe",referencedColumnName="id")
     */
    private $classe;







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

