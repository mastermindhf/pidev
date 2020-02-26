<?php

namespace CoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NoteQuiz
 *
 * @ORM\Table(name="note_quiz")
 * @ORM\Entity(repositoryClass="CoursBundle\Repository\NoteQuizRepository")
 */
class NoteQuiz
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
     * @ORM\Column(name="note", type="float",options={"default" : 0})
     */
    private $note;
    /**
     * @ORM\ManyToOne(targetEntity="Question")
     * @ORM\JoinColumn(name="id_q", referencedColumnName="id")
     */

    private $question;
    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="id_u", referencedColumnName="id")
     */
    private $user;
    /**
     * @ORM\ManyToOne(targetEntity="Cours")
     * @ORM\JoinColumn(name="id_C", referencedColumnName="id")
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
     * @return NoteQuiz
     */
    public function setCours($Cours)
    {
        $this->Cours = $Cours;
        return $this;
    }




    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
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

    /**
     * Set note
     *
     * @param float $note
     *
     * @return NoteQuiz
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
    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->getQuestion();
    }
}

