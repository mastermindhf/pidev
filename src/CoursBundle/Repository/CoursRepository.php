<?php

namespace CoursBundle\Repository;

/**
 * CoursRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CoursRepository extends \Doctrine\ORM\EntityRepository
{
    function SearchCours($libelle){
        $query=$this->getEntityManager()->createQuery("select e from CoursBundle:Cours e where e.libelle LIKE '%$libelle%'");
        return $query->getResult();

    }


}
