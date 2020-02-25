<?php

namespace SuiviBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use SuiviBundle\Entity\Classe;
use SuiviBundle\Entity\ListeAppel;
use SuiviBundle\Entity\Matiere;
use SuiviBundle\Entity\Note;
use SuiviBundle\Form\ListeAppelType;
use SuiviBundle\Form\NoteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

class NoteController extends Controller
{
    function AjoutNAction(Request $request,$id,$idc){
        $n=new Note();
        $eleve1=$this->getDoctrine()->getRepository(User::class)->Find($id);
        $classe=$this->getDoctrine()->getRepository(Classe::class)->find($idc);
        $Form = $this->createFormBuilder($n)
            ->add('eleve', EntityType::class, [

                    'class' => User::class,
                    'query_builder' => function (EntityRepository $er) use ($id) {
                        return $er->createQueryBuilder('u')
                            ->where('u.id =:id')->setParameter('id',$id);
                    },



                    'choice_label' => 'nom',


                ]


            )
            ->add('valeur')->add('matiere', EntityType::class, [

                    'class' => Matiere::class,


                    'choice_label' => 'libelle',


                ]


            )->add('captcha', CaptchaType::class)

            ->add('Ajouter',SubmitType::class,['attr'=>['formnovalidate'=>'formnovalidate']])
            ->getForm();
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
        $eleve=$em->getRepository(User::class)->find($ide);
        $mats=$em->getRepository(Matiere::class)->findAll();
        $n=$this->getDoctrine()->getRepository(Note::class)->finde($ide);

        $moyenne=$em->createQuery("select avg(n.valeur) from SuiviBundle:Note n where n.eleve=:ide")->setParameter('ide',$ide)
            ->getresult();
        return $this->render('@Suivi/Suivi/affichernote1.html.twig',array('n'=>$n,'mats'=>$mats,'e'=>$eleve,'mm'=>$moyenne[0][1]));
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

    function DeletennAction($id){
        $em=$this->getDoctrine()->getManager();
        $n = $em->getRepository(Note::class)->find($id);

        $em->remove($n);
        $em->flush();
        $e=$n->getEleve();
        $ide=$e->getId();
        return $this->redirectToRoute('afficherne',array('ide'=>$ide));
    }

}
