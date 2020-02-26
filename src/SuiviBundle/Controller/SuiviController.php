<?php

namespace SuiviBundle\Controller;

use Doctrine\ORM\EntityRepository;
use SuiviBundle\Entity\Classe;

use SuiviBundle\Entity\ListeAppel;
use SuiviBundle\Form\ListeAppelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use UserBundle\Form\RegistrationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SuiviController extends Controller
{
    function AfficherCAction(){

            $classe=new Classe();
            $cl=$this->getDoctrine()->getRepository(Classe::class)->findAll();
        return $this->render('@Suivi/Suivi/afficherc.html.twig',array('cl'=>$cl));
    }
    function AjoutLAAction($id,Request $request){
        $la=new ListeAppel();
        $eleve=$this->getDoctrine()->getRepository(User::class)->FindCl($id);
        $classe=$this->getDoctrine()->getRepository(Classe::class)->find($id);


        return $this->render('@Suivi/Suivi/ajoutla.html.twig',array('e'=>$eleve,'cl'=>$classe,'la'=>$la));
    }


    function AjoutAAction(Request $request,$ide,$idc){
        $la=new ListeAppel();
        $eleve1=$this->getDoctrine()->getRepository(User::class)->Find($ide);
        $classe=$this->getDoctrine()->getRepository(Classe::class)->find($idc);
        $Form=$this->createFormBuilder($la)
            ->add('eleve', EntityType::class, [

                    'class' => User::class,
                    'query_builder' => function (EntityRepository $er) use ($ide) {
                        return $er->createQueryBuilder('u')
                            ->where('u.id =:id')->setParameter('id',$ide);
                    },



                    'choice_label' => 'nom',


                ]


            ) ->add('date')

            ->add('Ajout',SubmitType::class,['attr'=>['formnovalidate'=>'formnovalidate']])
            ->getForm();
        $Form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        if($Form->isSubmitted() && $Form->isValid()) {

                $la->setEleve($eleve1);
                $la->setClasse($classe);
                $la->setEtat('Absent');
                $em->persist($la);
                $em->flush();

                return $this->redirectToRoute('affichela', array('id' => $idc));

            }
            return $this->render('@Suivi/Suivi/ajoutabsence.html.twig',array('form'=>$Form->createView()));


    }
    function AfficherLAAction($id){

        $la=$this->getDoctrine()->getRepository(ListeAppel::class)->findC($id);
        return $this->render('@Suivi/Suivi/afficherla.html.twig',array('la'=>$la));
    }

    function DeleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $la = $em->getRepository(ListeAppel::class)->find($id);

        $em->remove($la);
        $em->flush();
        $cl=$la->getClasse();
        $idc=$cl->getId();
        return $this->redirectToRoute('affichela',array('id'=>$idc));
    }
    function UpdateAction(Request $request,$id){

        $em=$this->getDoctrine()->getManager();
        $la = $em->getRepository(ListeAppel::class)->find($id);
        $Form=$this->createForm(ListeAppelType::class,$la);
        $Form->handleRequest($request);
        if($Form->isSubmitted() && $Form->isValid()) {
            $em->flush();
            $cl=$la->getClasse();
            $idc=$cl->getId();
            return $this->redirectToRoute('affichela',array('id'=>$idc));
        }

        return $this->render('@Suivi/Suivi/update.html.twig',array('form'=>$Form->createView()));
    }

    public function searchAction(Request $request)
    {
        $em =$this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $rec=$em->getRepository(User::class)->ChercherNom($requestString);

        if(!$rec) {
            $result['rec']['error'] = "Eleve Non Trouvé :( ";
        } else {
            $result['rec'] = $this->getRealEntities($rec);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($rec){
        foreach ($rec as $rec){
            $realEntities[$rec->getId()] = [$rec->getNom(),$rec->getPrenom(),$rec->getId(),$rec->getClasse()->getId()];

        }
        return $realEntities;
    }


}
