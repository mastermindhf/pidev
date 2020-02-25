<?php

namespace RecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * recparent
 *
 * @ORM\Table(name="recparent")
 * @ORM\Entity(repositoryClass="RecBundle\Repository\recparentRepository")
 */
class recparent
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
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     *
     * @ORM\JoinColumn(name="parent",referencedColumnName="id")
     */
    private $parent;

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     * @return recparent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
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
     * @return recparent
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

