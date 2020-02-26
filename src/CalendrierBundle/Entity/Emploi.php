<?php

namespace CalendrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emploi
 *
 * @ORM\Table(name="emploi")
 * @ORM\Entity(repositoryClass="CalendrierBundle\Repository\EmploiRepository")
 */
class Emploi
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
     * @ORM\Column(name="jour", type="string", length=255)
     */
    private $jour;

    /**
     * @var string
     *
     * @ORM\Column(name="seance_soir", type="string", length=255)
     */
    private $seanceSoir;


    /**
     * @var string
     *
     * @ORM\Column(name="seance_matin", type="string", length=255)
     */
    private $seanceMatin;

    /**
     *
     * @ORM\ManyToOne(targetEntity="prof")
     * @ORM\JoinColumn(name="prof_matin_id",referencedColumnName="id")
     */
    private $prof_matin;

    /**
     * @return string
     */
    public function getSeanceMatin()
    {
        return $this->seanceMatin;
    }

    /**
     * @param string $seanceMatin
     */
    public function setSeanceMatin($seanceMatin)
    {
        $this->seanceMatin = $seanceMatin;
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="prof")
     * @ORM\JoinColumn(name="prof_soir_id",referencedColumnName="id")
     */
    private $prof_soir;

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
     * @return mixed
     */
    public function getProfMatin()
    {
        return $this->prof_matin;
    }

    /**
     * @param mixed $prof_matin
     */
    public function setProfMatin($prof_matin)
    {
        $this->prof_matin = $prof_matin;
    }

    /**
     * @return mixed
     */
    public function getProfSoir()
    {
        return $this->prof_soir;
    }

    /**
     * @param mixed $prof_soir
     */
    public function setProfSoir($prof_soir)
    {
        $this->prof_soir = $prof_soir;
    }

    /**
     * Set jour
     *
     * @param string $jour
     *
     * @return Emploi
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * Get jour
     *
     * @return string
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * Set seanceSoir
     *
     * @param string $seanceSoir
     *
     * @return Emploi
     */
    public function setSeanceSoir($seanceSoir)
    {
        $this->seanceSoir = $seanceSoir;

        return $this;
    }

    /**
     * Get seanceSoir
     *
     * @return string
     */
    public function getSeanceSoir()
    {
        return $this->seanceSoir;
    }
}

