<?php

namespace RecEnsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * recens
 *
 * @ORM\Table(name="recens")
 * @ORM\Entity(repositoryClass="RecEnsBundle\Repository\recensRepository")
 */
class recens
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
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="ens",referencedColumnName="id")
     */
    private $ens;

    /**
     * @return mixed
     */
    public function getEns()
    {
        return $this->ens;
    }

    /**
     * @param mixed $ens
     * @return recens
     */
    public function setEns($ens)
    {
        $this->ens = $ens;
        return $this;
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
     * Set message
     *
     * @param string $message
     *
     * @return recens
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}

