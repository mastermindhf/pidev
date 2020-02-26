<?php

namespace CantineBundle\Repository;

/**
 * MenuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MenuRepository extends \Doctrine\ORM\EntityRepository
{



    public function myfind2($s){

        $query=$this->getEntityManager()->createQuery("select p from CantineBundle:Menu p where p.semaine=:s")
            ->setParameter('s',$s);
        return $query->getResult();


    }
}
