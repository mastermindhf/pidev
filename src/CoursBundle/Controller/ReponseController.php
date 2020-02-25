<?php

namespace CoursBundle\Controller;

use CoursBundle\Entity\Cours;
use CoursBundle\Entity\Question;
use CoursBundle\Entity\Reponse;
use CoursBundle\Form\ReponseType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ReponseController extends Controller
{
    public function AjouterReponseAction(Request $r)
    {
        $user = $this->getUser();
        if ($user != null) {
                $cours=$this->getDoctrine()->getRepository(Question::class)->findAll();
                return $this->render('@Cours/Reponse/ajout_Reponse.html.twig', array('c'=>$cours
                    // ...
                ));
            }



        return $this->redirectToRoute("fos_user_security_login");
    }


    public function AfficherReponseAction($id)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Reponse = $this->getDoctrine()->getRepository(Reponse::class)->myfind($id);
                return $this->render('@Cours/Reponse/afficher_Reponse.html.twig', array('Reponse' => $Reponse
                    // ...
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }
    public function AfficherReponseParQuestionAction(){
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Question = $this->getDoctrine()->getRepository(Question::class)->findAll();
                return $this->render('@Cours/Reponse/afficher_ReponseParQuestion.html.twig', array('Question' => $Question
                    // ...
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }
    public function SupprimerReponseAction($id)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Reponse = $this->getDoctrine()->getRepository(Reponse::class)->find($id);
                $em = $this->getDoctrine()->getManager();
                $em->remove($Reponse);
                $em->flush();
                return $this->redirectToRoute('AfficherReponse');

            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }
    public function ModifierReponseAction($id, Request $r)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Reponse = $this->getDoctrine()->getRepository(Reponse::class)->find($id);
                $form = $this->createFormBuilder($Reponse)->add('Reponse')->add('cours',EntityType::class, [

                        'class' => Question::class,

                        'choice_label' => 'libelle',


                    ]


                )->add('Modifier',SubmitType::class)->getForm();
                $form->handleRequest($r);
                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();

                    $em->flush();
                    return $this->redirectToRoute('AfficherReponse');
                }
                return $this->render('@Cours/Reponse/modifier_Reponse.html.twig', array('form' => $form->createView()
                    // ...
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }
    public function butAction(Request $request)
    {
        $question = $request->get('question');
        $reponse = $request->request->get('reponse');
        $etat = $request->request->get('etat');

        $qq=$this->getDoctrine()->getRepository(Question::class)->find($question);
        $number = count($reponse);
        echo $number;
        if ($number > 0) {
            for ($i = 0; $i < $number; $i++) {
                if (trim($reponse[$i] != '') && trim($etat[$i] != '')) {
                    $q = new Reponse();
                    $em = $this->getDoctrine()->getManager();
                    $q->setQuestion($qq);
                    $q->setReponse($reponse[$i]);
                    $q->setEtat($etat[$i]);
                    $em->persist($q);
                    $em->flush();

                }

            }

        }
        return $this->redirectToRoute('AfficherReponse');
    }
}
