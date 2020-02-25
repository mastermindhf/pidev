<?php

namespace RecEnsBundle\Controller;

use RecEnsBundle\Entity\recens;
use RecEnsBundle\Form\recensType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SuiviEnsBundle\Entity\Ens;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RecEnsController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ENSEIGNANT") {
                $reclamation = new recens();


                $form = $this->createForm(recensType::class, $reclamation);
                $form->handleRequest($request);
                $form1 = $form->createView();

                if ($form->isSubmitted()) {
                    $em = $this->getDoctrine()->getManager();

                    $em->persist($reclamation);
                    $em->flush();
                    return $this->redirectToRoute('_affiche_ens');

                }
                return $this->render('@RecEns/Default/ajout.html.twig', array('f' => $form1));

            }

        }

}
    function AfficheAction()
    {
        $rec= $this->getDoctrine()->getRepository(recens::class)->findAll();

        return $this->render('@RecEns/Default/Affiche.html.twig', array('c' => $rec));
    }
    public function SupprimerRecensAction($id)
    {
        $rec = $this->getDoctrine()->getRepository(recens::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($rec);
        $em->flush();
        return $this->redirectToRoute('_affiche_ens');

    }
    public function ModifierRecensAction($id, Request $r)
    {
        $rec = $this->getDoctrine()->getRepository(recens::class)->find($id);
        $form = $this->createFormBuilder($rec)->add('message',TextareaType::class)
            ->add('Modifier', SubmitType::class)->getForm();
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('_affiche_ens');
        }
        return $this->render('@RecEns/Default/modifierRecens.html.twig', array('form' => $form->createView()
            // ...
        ));
    }

    public function impAction()
    {
        $rec= $this->getDoctrine()->getRepository(recens::class)->findAll();


        return $this->render('@RecEns/Default/imp.html.twig', array(
            'c' => $rec,
        ));
    }
    function AfficheAdminAction()
    {
        $rec= $this->getDoctrine()->getRepository(recens::class)->findAll();

        return $this->render('@RecEns/Default/AfficheAdmin.html.twig', array('c' => $rec));
    }

}
