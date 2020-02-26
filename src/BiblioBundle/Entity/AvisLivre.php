<?php

namespace BiblioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AvisLivre
 *
 * @ORM\Table(name="avis_livre")
 * @ORM\Entity(repositoryClass="BiblioBundle\Repository\AvisLivreRepository")
 */
class AvisLivre
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
     * @return mixed
     */
    public function getLivre()
    {
        return $this->livre;
    }

    /**
     * @param mixed $livre
     * @return AvisLivre
     */
    public function setLivre($livre)
    {
        $this->livre = $livre;
        return $this;
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
     * @return AvisLivre
     */
    public function setIdeleve($ideleve)
    {
        $this->ideleve = $ideleve;
        return $this;
    }


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

