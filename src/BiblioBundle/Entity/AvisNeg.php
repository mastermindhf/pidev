<?php

namespace BiblioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AvisNeg
 *
 * @ORM\Table(name="avis_neg")
 * @ORM\Entity(repositoryClass="BiblioBundle\Repository\AvisNegRepository")
 */
class AvisNeg
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
     *
     * @ORM\ManyToOne(targetEntity="Livres",cascade={"remove"})
     * @ORM\JoinColumn(name="livre",referencedColumnName="idLivre",onDelete="CASCADE")
     */
    private $livre;


    /**
     * @var integer
     *
     * @ORM\Column(name="idEleve", type="integer", nullable=false)
     */
    private $ideleve;

    /**
     * @return mixed
     */
    public function getLivre()
    {
        return $this->livre;
    }

    /**
     * @param mixed $livre
     */
    public function setLivre($livre)
    {
        $this->livre = $livre;
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

