<?php

namespace SuiviEnsBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Suivi
 *
 * @ORM\Table(name="suivi")
 * @ORM\Entity(repositoryClass="SuiviEnsBundle\Repository\SuiviRepository")

 * @ORM\Table(name="suivi",uniqueConstraints={@ORM\UniqueConstraint(name="pk3", columns={"id_Ens"})})
 * @UniqueEntity(fields={"Ens"}, message="Vous avez déja éditer cet enseignant")

 */
class Suivi
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
     * @ORM\Column(name="pres_absc", type="string", length=255)
     */
    private $presAbsc;
    /**
     * @var \Date
     *
     * @ORM\Column(name="Date", type="date")
     */
    private $date;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\user")
     * @ORM\JoinColumn(name="id_Ens", referencedColumnName="id")
     */

    private $Ens;

    /**
     * @return mixed
     */
    public function getEns()
    {
        return $this->Ens;
    }

    /**
     * @param mixed $Ens
     */
    public function setEns($Ens)
    {
        $this->Ens = $Ens;
    }

    /**
     * @return \Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \Date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * Set presAbsc
     *
     * @param string $presAbsc
     *
     * @return Suivi
     */
    public function setPresAbsc($presAbsc)
    {
        $this->presAbsc = $presAbsc;

        return $this;
    }

    /**
     * Get presAbsc
     *
     * @return string
     */
    public function getPresAbsc()
    {
        return $this->presAbsc;
    }




}

