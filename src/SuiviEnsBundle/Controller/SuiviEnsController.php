<?php

namespace SuiviEnsBundle\Controller;

use SuiviEnsBundle\Entity\Ens;
use SuiviEnsBundle\Entity\Suivi;
use SuiviEnsBundle\Form\SuiviType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class SuiviEnsController extends Controller
{
    public function AjouterSuiviAction(Request $r)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ADMIN") {
                $suivi = new Suivi();
                $form = $this->createForm(SuiviType::class, $suivi);

                $form->handleRequest($r);
                if ($form->isSubmitted() AND $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $suivi->setDate(new \DateTime('now'));
                    $em->persist($suivi);
                    $em->flush();
                   return $this->redirectToRoute('affiche_ens');
                }
                return $this->render('@SuiviEns/Default/ajouter_suivi.html.twig', array('form' => $form->createView()
                    // ...
                ));


            }

        }
        return $this->redirectToRoute("fos_user_security_login");
            }


    public function AfficherSuiviAction()
    {
        $suiv = $this->getDoctrine()->getRepository(Suivi::class)->findAll();
        return $this->render('@SuiviEns/Default/afficher_Suivi.html.twig', array('suiv' => $suiv
            // ...
        ));
    }
    public function ModifierSuiviAction($id, Request $r)
    {
        $suivi = $this->getDoctrine()->getRepository(Suivi::class)->find($id);
        $form = $this->createFormBuilder($suivi)->add('presAbsc',ChoiceType::class, [
                'choices'  => [
                    'Présent' => 'Présent',
                    'Absent'  => 'Absent'

                ],
            ])  ->add('Ens',EntityType::class,array('class'=>Ens::class,'choice_label'=>'nom',))
            ->add('Modifier',SubmitType::class)
                ->getForm();
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
           # return $this->redirectToRoute('');
        }
        return $this->render('@SuiviEns/Default/modifier_suivi.html.twig', array('form' => $form->createView()
            // ...
        ));
    }
    public function SupprimerSuiviAction($id)
    {
        $suivi = $this->getDoctrine()->getRepository(Suivi::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($suivi);
        $em->flush();
        return $this->redirectToRoute('affiche_ens');

    }
}
