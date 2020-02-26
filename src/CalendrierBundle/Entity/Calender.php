<?php

namespace CalendrierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calender
 *
 * @ORM\Table(name="calender")
 * @ORM\Entity(repositoryClass="CalendrierBundle\Repository\CalenderRepository")
 */
class Calender
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
     * @ORM\ManyToOne(targetEntity="jour")
     * @ORM\JoinColumn(name="jour",referencedColumnName="id")
     */
    private $jour;


    /**
     *
     * @ORM\ManyToOne(targetEntity="prof")
     * @ORM\JoinColumn(name="matiere",referencedColumnName="id")
     */
    private $matiere;


    /**
     *
     * @ORM\ManyToOne(targetEntity="prof")
     * @ORM\JoinColumn(name="prof",referencedColumnName="id")
     */
    private $prof;



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

