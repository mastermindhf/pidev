<?php

namespace CoursBundle\Controller;

use CoursBundle\Entity\Cours;
use CoursBundle\Entity\Quizz;
use CoursBundle\Form\CoursType;
use CoursBundle\Form\QuizzType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class CoursController extends Controller
{


    public function AjouterCoursAction(Request $r)
    {
        $user=$this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0]=="ADMIN"){
        $Cours = new Cours();
        $form = $this->createForm(CoursType::class, $Cours);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Cours);
            $em->flush();
            return $this->redirectToRoute('AfficherCours');
        }
                return $this->render('@Cours/Cours/ajouter_cours.html.twig', array('form' => $form->createView()
                    // ...
                ));}


        }
        return $this->redirectToRoute("fos_user_security_login");
    }

    public function AfficherCoursAction()
    {
        $Cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
        return $this->render('@Cours/Cours/afficher_cours.html.twig', array('Cours' => $Cours
            // ...
        ));
    }

    public function ModifierCoursAction($id, Request $r)
    {
        $Cours = $this->getDoctrine()->getRepository(Cours::class)->find($id);
        $form = $this->createFormBuilder($Cours)->add('Libelle')->add('Niveau')->add('Modifier', SubmitType::class)->getForm();
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficherCours');
        }
        return $this->render('@Cours/Cours/modifier_cours.html.twig', array('form' => $form->createView()
            // ...
        ));
    }

    public function SupprimerCoursAction($id)
    {
        $Cours = $this->getDoctrine()->getRepository(Cours::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Cours);
        $em->flush();
       return $this->redirectToRoute('AfficherCours');

    }
    public function AfficherCoursFAction(){
        $Cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
        return $this->render('@Cours/Cours/afficher_coursf.html.twig', array('Cours' => $Cours
            // ...
        ));
    }
    public function AjouterQuizzAction(Request $r)
    {
        $Quizz = new Quizz();
        $form = $this->createForm(QuizzType::class, $Quizz);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Quizz);
            $em->flush();
            return $this->redirectToRoute('AfficherQuizz');
        }
        return $this->render('@Cours/Cours/ajouter_Quizz.html.twig', array('form' => $form->createView()
            // ...
        ));
    }

    public function AfficherQuizzAction()
    {
        $Quizz = $this->getDoctrine()->getRepository(Cours::class)->findAll();
        return $this->render('@Cours/Cours/afficher_QuizzC.html.twig', array('Quizz' => $Quizz
            // ...
        ));
    }
    public function AfficherQuizzByCoursAction($cours)
    {
        $Quizz = $this->getDoctrine()->getRepository(Quizz::class)->myfind($cours);
        return $this->render('@Cours/Cours/afficher_Quizz.html.twig', array('Quizz' => $Quizz
            // ...
        ));
    }

    public function ModifierQuizzAction($id, Request $r)
    {
        $Quizz = $this->getDoctrine()->getRepository(Quizz::class)->find($id);
        $form = $this->createFormBuilder($Quizz)->add('question')->add('reponse')->add('reponse1')->add('juste')->add('cours',EntityType::class, [

                'class' => Cours::class,

                'choice_label' => 'libelle',


            ]


        )->add('Modifier', SubmitType::class)->getForm();
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('AfficherQuizz');
        }
        return $this->render('@Cours/Cours/modifier_Quizz.html.twig', array('form' => $form->createView()
            // ...
        ));
    }

    public function SupprimerQuizzAction($id)
    {
        $Quizz = $this->getDoctrine()->getRepository(Quizz::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Quizz);
        $em->flush();
        return $this->redirectToRoute('AfficherQuizz');

    }

public function QuizAction($cours,$libelle){
    $Quizz = $this->getDoctrine()->getRepository(Quizz::class)->myfinda($cours,$libelle);
    return $this->render('@Cours/Cours/Quizz.html.twig', array('Quizz' => $Quizz
        // ...
    ));
}
}
