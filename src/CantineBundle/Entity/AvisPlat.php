<?php

namespace CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AvisPlat
 *
 * @ORM\Table(name="avisplat")
 * @ORM\Entity(repositoryClass="CantineBundle\Repository\AvisPlatRepository")



 */



class AvisPlat
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
     * @return int
     */
    public function getIdeleve()
    {
        return $this->ideleve;
    }

    /**
     * @param int $ideleve
     */
    public function setIdeleve($ideleve)
    {
        $this->ideleve = $ideleve;
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="Plat",cascade={"remove"})
     * @ORM\JoinColumn(name="plat",referencedColumnName="id",onDelete="CASCADE")
     */
    private $plat;

    /**
     * @var integer
     *
     * @ORM\Column(name="idEleve", type="integer", nullable=false)
     */
    private $ideleve;



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

