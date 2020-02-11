<?php

namespace SuiviBundle\Controller;

use SuiviBundle\Entity\Classe;
use SuiviBundle\Entity\Eleve;
use SuiviBundle\Entity\ListeAppel;
use SuiviBundle\Form\ListeAppelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SuiviController extends Controller
{
    function AfficherCAction(){

            $classe=new Classe();
            $cl=$this->getDoctrine()->getRepository(Classe::class)->findAll();
        return $this->render('@Suivi/Suivi/afficherc.html.twig',array('cl'=>$cl));
    }
    function AjoutLAAction($id){
        $la=new ListeAppel();
        $eleve=$this->getDoctrine()->getRepository(Eleve::class)->FindCl($id);
        $classe=$this->getDoctrine()->getRepository(Classe::class)->find($id);


        return $this->render('@Suivi/Suivi/ajoutla.html.twig',array('e'=>$eleve,'cl'=>$classe,'la'=>$la));
    }


    function AjoutAAction(Request $request,$ide,$idc){
        $la=new ListeAppel();
        $eleve1=$this->getDoctrine()->getRepository(Eleve::class)->Find($ide);
        $classe=$this->getDoctrine()->getRepository(Classe::class)->find($idc);

        $em=$this->getDoctrine()->getManager();


            $la->setEleve($eleve1);
            $la->setClasse($classe);
            $la->setEtat('Absent');
            $la->setDate(new \Datetime('now'));
            $em->persist($la);
            $em->flush();

            return $this->redirectToRoute('affichela',array('id'=>$idc));




    }
    function AfficherLAAction($id){

        $la=$this->getDoctrine()->getRepository(ListeAppel::class)->findC($id);



        return $this->render('@Suivi/Suivi/afficherla.html.twig',array('la'=>$la));


    }

}
