<?php

namespace SuiviBundle\Controller;

use SuiviBundle\Entity\Classe;
use SuiviBundle\Entity\Eleve;
use SuiviBundle\Entity\ListeAppel;
use SuiviBundle\Entity\Matiere;
use SuiviBundle\Entity\Note;
use SuiviBundle\Form\ListeAppelType;
use SuiviBundle\Form\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class NoteController extends Controller
{
    function AjoutNAction(Request $request,$id,$idc){
        $n=new Note();
        $eleve1=$this->getDoctrine()->getRepository(Eleve::class)->Find($id);
        $classe=$this->getDoctrine()->getRepository(Classe::class)->find($idc);
        $Form=$this->createForm(NoteType::class,$n);
        $Form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        if($Form->isSubmitted() && $Form->isValid()) {

            $n->setEleve($eleve1);
            $n->setClasse($classe);
            $em->persist($n);
            $em->flush();
            $e=$n->getEleve();
            $ide=$e->getId();

            return $this->redirectToRoute('afficherne', array('ide' => $ide));

        }
        return $this->render('@Suivi/Suivi/ajoutnote.html.twig',array('form'=>$Form->createView()));


    }
    function AfficherncAction($idc){

        $em=$this->getDoctrine()->getManager();
        $n=$this->getDoctrine()->getRepository(Note::class)->findc($idc);
        $mats=$em->getRepository(Matiere::class)->findAll();
        return $this->render('@Suivi/Suivi/affichernote.html.twig',array('n'=>$n,'mats'=>$mats));
    }
    function AfficherneAction($ide){
        $em=$this->getDoctrine()->getManager();

        $mats=$em->getRepository(Matiere::class)->findAll();
        $n=$this->getDoctrine()->getRepository(Note::class)->finde($ide);
        return $this->render('@Suivi/Suivi/affichernote.html.twig',array('n'=>$n,'mats'=>$mats));
    }

    function DeletenAction($id){
        $em=$this->getDoctrine()->getManager();
        $n = $em->getRepository(Note::class)->find($id);

        $em->remove($n);
        $em->flush();
        $e=$n->getClasse();
        $idc=$e->getId();
        return $this->redirectToRoute('affichernc',array('idc'=>$idc));
    }
    function UpdatenAction(Request $request,$id){

        $em=$this->getDoctrine()->getManager();
        $n = $em->getRepository(Note::class)->find($id);
        $Form = $this->createFormBuilder($n)->add('valeur')->add('Modifier', SubmitType::class)->getForm();
        $Form->handleRequest($request);
        if($Form->isSubmitted() && $Form->isValid()) {
            $em->flush();
            $e=$n->getClasse();
            $idc=$e->getId();
            return $this->redirectToRoute('affichernc',array('idc'=>$idc));
        }

        return $this->render('@Suivi/Suivi/Updaten.html.twig',array('form'=>$Form->createView()));
    }
    function Afficherne2Action($ide){
        $em=$this->getDoctrine()->getManager();

        $mats=$em->getRepository(Matiere::class)->findAll();
        $n=$this->getDoctrine()->getRepository(Note::class)->finde($ide);
        $la=$this->getDoctrine()->getRepository(ListeAppel::class)->Finde($ide);
        return $this->render('@Suivi/Suivi/affichernfront.html.twig',array('n'=>$n,'mats'=>$mats,'la'=>$la));
    }

}
