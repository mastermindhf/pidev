<?php

namespace CoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wish
 *
 * @ORM\Table(name="wish")
 * @ORM\Entity(repositoryClass="CoursBundle\Repository\WishRepository")
 */
class Wish
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
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumn(name="id_c", referencedColumnName="id")
     */

    private $cours;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\user")
     * @ORM\JoinColumn(name="id_u", referencedColumnName="id")
     */

    private $user;

    /**
     * @return mixed
     */
    public function getCours()
    {
        return $this->cours;
    }

    /**
     * @param mixed $cours
     */
    public function setCours($cours)
    {
        $this->cours = $cours;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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

