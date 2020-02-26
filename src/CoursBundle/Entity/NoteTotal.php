<?php

namespace CoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NoteTotal
 *
 * @ORM\Table(name="note_total")
 * @ORM\Entity(repositoryClass="CoursBundle\Repository\NoteTotalRepository")
 */
class NoteTotal
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
     * @var float
     *
     * @ORM\Column(name="note", type="float",nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumn(name="cours", referencedColumnName="id")
     */

    private $Cours;

    /**
     * @return mixed
     */
    public function getCours()
    {
        return $this->Cours;
    }

    /**
     * @param mixed $Cours
     * @return NoteTotal
     */
    public function setCours($Cours)
    {
        $this->Cours = $Cours;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * @param mixed $User
     * @return NoteTotal
     */
    public function setUser($User)
    {
        $this->User = $User;
        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     */

    private $User;
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
     * Set note
     *
     * @param float $note
     *
     * @return NoteTotal
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }
}

