<?php

namespace CantineBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="CantineBundle\Repository\NotificationRepository")
 */
class Notification
{
    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param int $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

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
     * @var string
     *
     * @ORM\Column(name="user", type="string")
     */
    private $user;
    /**
     *
     * @ORM\ManyToOne(targetEntity="Plat",cascade={"remove"})
     * @ORM\JoinColumn(name="plat",referencedColumnName="id",onDelete="CASCADE")
     */
    private $plat;


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

