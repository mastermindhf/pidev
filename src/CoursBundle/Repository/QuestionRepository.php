<?php

namespace CoursBundle\Repository;

/**
 * QuestionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuestionRepository extends \Doctrine\ORM\EntityRepository
{
    public function myfind($id)
    {
        $query = $this->getEntityManager()->createQuery("select e from CoursBundle:Question e where e.Cours = '$id'");
        return $query->getResult();
    }
    public function findQuestion($id)
    {
        $query = $this->getEntityManager()->createQuery("select e from CoursBundle:Question e where e.Cours = '$id' ")->setMaxResults(3);
        return $query->getResult();
    }

}
