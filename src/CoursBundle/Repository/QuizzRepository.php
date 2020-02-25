<?php

namespace CoursBundle\Repository;

/**
 * QuizzRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuizzRepository extends \Doctrine\ORM\EntityRepository
{
    public function myfind($cours){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM CoursBundle:Quizz p
            WHERE p.cours = :cours
            '
        )->setParameter('cours', $cours);

        // returns an array of Product objects
        return $query->getResult();
    }
    public function myfinda($cours,$libelle){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM CoursBundle:Quizz p
            WHERE p.libelle = :libelle and p.cours=:cours
            '
        )->setParameter('libelle', $libelle)
        ->setParameter('cours', $cours);

        // returns an array of Product objects
        return $query->getResult();
    }
}
