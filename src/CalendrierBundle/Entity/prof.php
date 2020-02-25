<?php

namespace CalendrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * prof
 *
 * @ORM\Table(name="prof")
 * @ORM\Entity(repositoryClass="CalendrierBundle\Repository\profRepository")
 */
class prof
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\Column(name="nbheures", type="integer")
     */
    private $nbheures;

    /**
     * @var string
     *
     * @ORM\Column(name="matiere", type="string", length=255)
     */
    private $matiere;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return prof
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set nbheures
     *
     * @param integer $nbheures
     *
     * @return prof
     */
    public function setNbheures($nbheures)
    {
        $this->nbheures = $nbheures;

        return $this;
    }

    /**
     * Get nbheures
     *
     * @return int
     */
    public function getNbheures()
    {
        return $this->nbheures;
    }

    /**
     * Set matiere
     *
     * @param string $matiere
     *
     * @return prof
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return string
     */
    public function getMatiere()
    {
        return $this->matiere;
    }
}

