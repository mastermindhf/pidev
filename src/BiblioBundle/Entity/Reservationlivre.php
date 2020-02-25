<?php

namespace BiblioBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Reservationlivre
 *
 * @ORM\Table(name="Reservationlivre")
 * @ORM\Entity(repositoryClass="BiblioBundle\Repository\ReservationlivreRepository")
 */
class Reservationlivre
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="idLivre", type="integer", nullable=false)
     */
    private $idlivre;

    /**
     * @var integer
     *
     * @ORM\Column(name="idEleve", type="integer", nullable=false)
     */
    private $ideleve;

    /**
     * @return int
     */
    public function getIdlivre()
    {
        return $this->idlivre;
    }

    /**
     * @param int $idlivre
     */
    public function setIdlivre($idlivre)
    {
        $this->idlivre = $idlivre;
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

