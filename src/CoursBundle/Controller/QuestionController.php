<?php

namespace CoursBundle\Controller;

use CoursBundle\Entity\Cours;
use CoursBundle\Entity\Niveau;
use CoursBundle\Entity\NoteQuiz;
use CoursBundle\Entity\Question;
use CoursBundle\Entity\Reponse;
use CoursBundle\Form\QuestionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{
    public function AjouterQuestionAction(Request $r)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Question = new Question();
                $form = $this->createForm(QuestionType::class, $Question);
                $form->add('Ajouter', SubmitType::class);
                $form->handleRequest($r);
                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($Question);
                    $em->flush();

                }
                return $this->render('@Cours/Question/ajout_question.html.twig', array('form' => $form->createView()
                    // ...
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }


    public function AfficherQuestionAction($id)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Question = $this->getDoctrine()->getRepository(Question::class)->myfind($id);
                $q = count($Question);
                return $this->render('@Cours/Question/afficher_Question.html.twig', array('Question' => $Question
                , 'q' => $q
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }

    public function AfficherQuestionParCoursAction()
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
                return $this->render('@Cours/Question/afficher_QuestionParCours.html.twig', array('Cours' => $Cours
                    // ...
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }

    public function SupprimerQuestionAction($id)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Question = $this->getDoctrine()->getRepository(Question::class)->find($id);
                $em = $this->getDoctrine()->getManager();
                $em->remove($Question);
                $em->flush();
                return $this->redirectToRoute('AfficherQuestion');

            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }

    public function ModifierQuestionAction($id, Request $r)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Question = $this->getDoctrine()->getRepository(Question::class)->find($id);
                $form = $this->createFormBuilder($Question)->add('question')->add('cours', EntityType::class, [

                        'class' => Cours::class,

                        'choice_label' => 'libelle',


                    ]


                )->add('Modifier', SubmitType::class)->getForm();
                $form->handleRequest($r);
                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();

                    $em->flush();
                    return $this->redirectToRoute('AfficherQuestion');
                }
                return $this->render('@Cours/Question/modifier_Question.html.twig', array('form' => $form->createView()
                    // ...
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }

    public function PasserQuizAction($idC = 1)
    {
        $q = $this->getDoctrine()->getRepository(Question::class)->findQuestion($idC);


        return $this->render('@Cours/Cours/passer_quiz.html.twig', array('q' => $q
            // ...
        ));
    }

    public function RepondreAction($id)
    {     $note=new NoteQuiz();
        $user=$this->getUser();
        $note->setUser($user);
        $question=$this->getDoctrine()->getRepository(Question::class)->find($id);
        $note->setQuestion($question);
        $note->setNote(0);
        $em=$this->getDoctrine()->getManager();
        $em->persist($note);
        $em->flush();
        $rep = $this->getDoctrine()->getRepository(Reponse::class)->findBy(['Question' => $id]);
        return $this->render('@Cours/Cours/repondre_quiz.html.twig', array('r' => $rep
            // ...
        ));
    }

    public function ScoreAction(Request $r)

    {  $score=0;
        $note=new NoteQuiz();
        $user=$this->getUser();
        $userId = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
        $reponse = $r->request->get('rep');
        $q = $r->request->get('q');
       $s=count($nbrCorrect=$this->getDoctrine()->getRepository(Reponse::class)->findAllCorrect($q));
       $question=$this->getDoctrine()->getRepository(Question::class)->find($q);

        if( $reponse==''){
           $note->setUser($user);
           $note->setQuestion($question);
           $note->setNote($note->getNote()+0);
           $em=$this->getDoctrine()->getManager();
           $em->flush();
        } else {
            foreach ($reponse as $re) {
                $Reponse = $this->getDoctrine()->getRepository(Reponse::class)->findCorrect($re);

                foreach ($Reponse as $rr) {


                    $x = $rr->getEtat();
                    //dump($x);
                    if ($x== 'Faux') {

                        $score=0;

                    }
                    if ($x=='Vrai'){

                        $score=$score+1;
                    }
                }


            }
            $score=$score/$s;
            $note->setUser($user);
            $note->setQuestion($question);
            $note->setNote($note->getNote()+$score);
            $em=$this->getDoctrine()->getManager();
            $this->getDoctrine()->getRepository(NoteQuiz::class)->findCondition($user,$question);
            $em->persist($note);

            $em->flush();




        }
        return $this->render('@Cours/Cours/test.html.twig', array('s' => $score
            // ...
        ));
    }
}
