<?php

namespace CoursBundle\Repository;

/**
 * NoteQuizRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NoteQuizRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCondition($user,$question)
    {
        $query = $this->getEntityManager()->createQuery("delete from CoursBundle:NoteQuiz e where e.question =:ques and e.user=:user")
            ->setParameter('ques',$question)
            ->setParameter('user',$user)
        ;
        return $query->getResult();
    }
}
