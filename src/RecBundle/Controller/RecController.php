<?php

namespace RecBundle\Controller;

use RecBundle\Entity\recparent;
use RecBundle\Form\recparentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RecController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "PARENT") {
                $reclamation = new recparent();


                $form = $this->createForm(recparentType::class, $reclamation);
                $form->handleRequest($request);
                $form1 = $form->createView();

                if ($form->isSubmitted()) {
                    $em = $this->getDoctrine()->getManager();
                    $reclamation->setParent($user);
                    $em->persist($reclamation);
                    $em->flush();
                    return $this->redirectToRoute('_affiche');

                }
                return $this->render('@Rec/Default/ajout.html.twig', array('f' => $form1,'user'=>$user));

            }

        }
        return $this->redirectToRoute("fos_user_security_login");
    }
    function AfficheAction()
    {
        $rec= $this->getDoctrine()->getRepository(recparent::class)->findAll();

        return $this->render('@Rec/Default/Affiche.html.twig', array('c' => $rec));
    }
    public function SupprimerRecAction($id)
    {
        $rec = $this->getDoctrine()->getRepository(recparent::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($rec);
        $em->flush();
        return $this->redirectToRoute('_affiche');

    }
    public function ModifierRecAction($id, Request $r)
    {
        $rec = $this->getDoctrine()->getRepository(recparent::class)->find($id);
        $form = $this->createFormBuilder($rec)->add('message',TextareaType::class)->add('Modifier', SubmitType::class)->getForm();
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('_affiche');
        }
        return $this->render('@Rec/Default/modifierRec.html.twig', array('form' => $form->createView()
            // ...
        ));
    }
}
