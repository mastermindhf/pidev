<?php

namespace BiblioBundle\Repository;

/**
 * LivresRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LivresRepository extends \Doctrine\ORM\EntityRepository
{
    public function mefind($name){
        $query=$this->getEntityManager()
            ->createQuery("select m from BiblioBundle:Livres m where m.nom like :name ");
        $query->setParameter(":name",'%'.$name.'%');
        return $query->getResult();
    }

    public function getAllAboutLivre($id)
    {
        $query  = $this->getEntityManager()->createQuery("SELECT R FROM BiblioBundle:Livres R WHERE R.idLivre = :id");
        $query->setParameter('id', $id);
        return $query->getResult();
    }

    public function findMQ(){
        $query=$this->getEntityManager()
            ->createQuery("select m.nom,m.quantite from BiblioBundle:Livres m ");
               return $query->getResult();
    }

    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM BiblioBundle:Livres p
                WHERE p.nom LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }

    public function findNb(){
        $query=$this->getEntityManager()
            ->createQuery("select count(m.nom) from BiblioBundle:Livres m ");
        return $query->getResult();
    }
}