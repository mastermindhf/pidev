<?php

namespace CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AvisNegatif
 *
 * @ORM\Table(name="avis_negatif")
 * @ORM\Entity(repositoryClass="CantineBundle\Repository\AvisNegatifRepository")
 */
class AvisNegatif
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @ORM\ManyToOne(targetEntity="Plat",cascade={"remove"})
     * @ORM\JoinColumn(name="plat",referencedColumnName="id",onDelete="CASCADE")
     */
    private $plat;

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
     * @var integer
     *
     * @ORM\Column(name="idEleve", type="integer", nullable=false)
     */
    private $ideleve;

}

