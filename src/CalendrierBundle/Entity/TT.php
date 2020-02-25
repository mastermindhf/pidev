<?php

namespace CalendrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TT
 *
 * @ORM\Table(name="t_t")
 * @ORM\Entity(repositoryClass="CalendrierBundle\Repository\TTRepository")
 */
class TT
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

