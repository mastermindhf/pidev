<?php

namespace SuiviBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Note
 *
 * @ORM\Table(name="note")
 * @UniqueEntity(fields={"matiere","eleve"}, message="cette eleve est déja noté")
 * @ORM\Entity(repositoryClass="SuiviBundle\Repository\NoteRepository")
 */
class Note
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
     * @var float
     *
     * @ORM\Column(name="valeur", type="float")
     */
    private $valeur;

    /**
     * @return mixed
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param mixed $matiere
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;
    }
    /**
     * @ORM\ManyToOne(targetEntity="matiere")
     * @ORM\JoinColumn(name="id_m", referencedColumnName="id")
     */

    private $matiere;
    /**
 * @ORM\ManyToOne(targetEntity="eleve")
 * @ORM\JoinColumn(name="id_e", referencedColumnName="id")
 */

    private $eleve;

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
     * @ORM\ManyToOne(targetEntity="classe")
     * @ORM\JoinColumn(name="id_c", referencedColumnName="id")
     */

    private $classe;
    /**
     * @return mixed
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param mixed $eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }

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
     * Set valeur
     *
     * @param float $valeur
     *
     * @return Note
     */
    public function setValeur($valeur)
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * Get valeur
     *
     * @return float
     */
    public function getValeur()
    {
        return $this->valeur;
    }
}

