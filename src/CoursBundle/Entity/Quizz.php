<?php

namespace CoursBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quizz
 *
 * @ORM\Table(name="quizz")
 * @ORM\Entity(repositoryClass="CoursBundle\Repository\QuizzRepository")
 */
class Quizz
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
     * @ORM\ManyToOne(targetEntity="cours")
     * @ORM\JoinColumn(name="cours", referencedColumnName="id")
     */

    private $cours;
    /**
     * @var string
     *
     * @ORM\Column(name="question", type="text", length=1000)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse", type="string", length=255)
     */
    private $reponse;

    /**
     * @var string
     *
     * @ORM\Column(name="reponse1", type="string", length=255)
     */
    private $reponse1;

    /**
     * @var string
     *
     * @ORM\Column(name="juste", type="string", length=255)
     */
    private $juste;



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
     * @return Quizz
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
     * Set reponse
     *
     * @param string $reponse
     *
     * @return Quizz
     */
    public function setReponse($reponse)
    {
        $this->reponse = $reponse;

        return $this;
    }

    /**
     * Get reponse
     *
     * @return string
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set reponse1
     *
     * @param string $reponse1
     *
     * @return Quizz
     */
    public function setReponse1($reponse1)
    {
        $this->reponse1 = $reponse1;

        return $this;
    }

    /**
     * Get reponse1
     *
     * @return string
     */
    public function getReponse1()
    {
        return $this->reponse1;
    }

    /**
     * Set juste
     *
     * @param string $juste
     *
     * @return Quizz
     */
    public function setJuste($juste)
    {
        $this->juste = $juste;

        return $this;
    }

    /**
     * Get juste
     *
     * @return string
     */
    public function getJuste()
    {
        return $this->juste;
    }

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



}

