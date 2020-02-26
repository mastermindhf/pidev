<?php

namespace CoursBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="CoursBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\JoinColumn(name="id_C", referencedColumnName="id")
     */

    private $Cours;

    /**
     * @var string
     *
     * @ORM\Column(name="Question", type="string", length=1000)
     */
    private $question;

    /**
     * @var \DateTime
     * @Assert\GreaterThan("-1 years")
     *@Assert\GreaterThanOrEqual("today")
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
     * Set question
     *
     * @param string $question
     *
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return mixed
     */
    public function getCours()
    {
        return $this->Cours;
    }

    /**
     * @param mixed $Cours
     */
    public function setCours($Cours)
    {
        $this->Cours = $Cours;
    }

}

