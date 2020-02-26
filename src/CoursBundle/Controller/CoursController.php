<?php

namespace CoursBundle\Controller;

use CoursBundle\Entity\Cours;
use CoursBundle\Entity\Niveau;
use CoursBundle\Entity\Quizz;
use CoursBundle\Entity\Wish;
use CoursBundle\Form\CoursType;
use SuiviBundle\Entity\Matiere;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CoursController extends Controller
{


    public function AjouterCoursAction(Request $r)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Cours = new Cours();
                $form = $this->createForm(CoursType::class, $Cours);
                $form->add('Ajouter', SubmitType::class);
                $form->handleRequest($r);
                if ($form->isSubmitted()&& $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($Cours);
                    $em->flush();
                    return $this->redirectToRoute('AfficherCours');
                }
                return $this->render('@Cours/Cours/ajouter_cours.html.twig', array('form' => $form->createView()
                    // ...
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }

    public function AfficherCoursAction()
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
                return $this->render('@Cours/Cours/afficher_cours.html.twig', array('Cours' => $Cours
                    // ...
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }

    public function ModifierCoursAction($id, Request $r)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Cours = $this->getDoctrine()->getRepository(Cours::class)->find($id);
                $form = $this->createFormBuilder($Cours)->add('Libelle')->add('Niveau', ChoiceType::class,
                    array('choices' => array('1' => '1', '2' => '2'
                    , '3' => '3'
                    , '4' => '4'
                    , '5' => '5'
                    , '6' => '6')))->add('matiere', EntityType::class, [

                        'class' => Matiere::class,


                        'choice_label' => 'libelle',


                    ]


                )->add('Modifier', SubmitType::class)->add('contractFile', VichFileType::class,['data_class'=>null, 'required'=>false])->getForm();
               // $form->add('contractFile', VichFileType::class);
                $form->handleRequest($r);
                if ($form->isSubmitted() && $form->isValid()) {
                    /** @var UploadedFile $file */
                    $em = $this->getDoctrine()->getManager();

                    $em->flush();
                    return $this->redirectToRoute('AfficherCours');
                }
                return $this->render('@Cours/Cours/modifier_cours.html.twig', array('form' => $form->createView()
                    // ...
                ));
            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }

    public function SupprimerCoursAction($id)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $Cours = $this->getDoctrine()->getRepository(Cours::class)->find($id);
                $em = $this->getDoctrine()->getManager();
                $em->remove($Cours);
                $em->flush();
                return $this->redirectToRoute('AfficherCours');

            }


        }
        return $this->redirectToRoute("fos_user_security_login");
    }


    public function downloadAction($filename)
    {

        $path = $this->get('kernel')->getRootDir() . "/../web/Cours/";
        $content = file_get_contents($path . $filename);

        $response = new Response();

        //set headers
        $response->headers->set('Content-Type', 'mime/type');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename);

        $response->setContent($content);
        return $response;
    }

    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $libelle = $request->get('q');
        $rec = $em->getRepository('CoursBundle:Cours')->SearchCours($libelle);

        if (!$rec) {
            $result['cours']['error'] = "Cours Non Existant :( ";
        } else {
            $result['cours'] = $this->getRealEntities($rec);
        }
        return new Response(json_encode($result));
    }

    public function getRealEntities($rec)
    {
        foreach ($rec as $rec) {
            $realEntities[$rec->getId()] = [$rec->getLibelle(),  $rec->getContract()];

        }
        return $realEntities;
    }

    public function AddAction($id)
    {

        $userId = $this->container->get('security.token_storage')->getToken()->getUser()->getId();

        $w = new Wish();
        $cour = $this->getDoctrine()->getRepository(Cours::class)->find($id);
        $user = $this->getDoctrine()->getRepository(User::class)->find($userId);

        $w->setCours($cour);
        $w->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($w);
            $em->flush();
            return $this->redirectToRoute('AfficherCours');


    }
    public function AfficherFrontAction(){
        $user = $this->getUser();

        $w=$this->getDoctrine()->getRepository(Wish::class)->findMesCours();
        $Cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
        return $this->render('@Cours/Cours/afficher_coursf.html.twig', array('Cours' => $Cours,'u'=>$user,'w'=>$w)
            // ...
        );
    }



}
