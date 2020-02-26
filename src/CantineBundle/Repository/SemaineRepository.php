<?php

namespace CantineBundle\Repository;

/**
 * SemaineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SemaineRepository extends \Doctrine\ORM\EntityRepository
{
    public function myfind($nw){

        $query=$this->getEntityManager()->createQuery("select p from CantineBundle:Semaine p where p.debut=:nw")
            ->setParameter('nw',$nw);
        return $query->getResult();}
}