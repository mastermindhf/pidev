<?php

namespace SuiviBundle\Repository;

/**
 * EleveRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EleveRepository extends \Doctrine\ORM\EntityRepository
{
    function FindCl($id){
        $query=$this->getEntityManager()->createQuery("select e from SuiviBundle:Eleve e where e.classe=:idc")->setParameter('idc',$id);
        return $query->getResult();

    }
    function FindNom($nom){
        $query=$this->getEntityManager()->createQuery("select e from SuiviBundle:Eleve e where e.nom LIKE '%$nom%'");
        return $query->getResult();

    }
}
