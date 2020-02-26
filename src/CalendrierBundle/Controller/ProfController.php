<?php

namespace CalendrierBundle\Controller;

use CalendrierBundle\Entity\prof;
use CalendrierBundle\Form\EmploiType;
use CalendrierBundle\Form\profType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ProfController extends Controller
{
    /**
     * @Route("/ajouterProf")
     */
    public function ajouterProfAction(Request $req)
    {
       $prof=new prof();
        $form = $this->createForm(EmploiType::class,$prof)->add("ajouter",SubmitType::class);
        $form->handleRequest($req);


        if($form->isSubmitted())
        {

            $em=$this->getDoctrine()->getManager();
            $em->persist($prof);
            $em->flush();
           return $this->redirectToRoute("afficherProf");
        }

        return $this->render('@Calendrier/prof/ajouter_prof.html.twig', array("f"=>$form->createView()
            // ...
        ));
    }



    public function  afficherProfAction()
    {
        $rep=$this->getDoctrine()->getRepository(prof::class)->findAll();
        return $this->render('@Calendrier/prof/afficher_prof.html.twig', array("e"=>$rep));

    }

}
