<?php

namespace CalendrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LikePlat
 *
 * @ORM\Table(name="like_plat")
 * @ORM\Entity(repositoryClass="CalendrierBundle\Repository\LikePlatRepository")
 */
class LikePlat
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
}

