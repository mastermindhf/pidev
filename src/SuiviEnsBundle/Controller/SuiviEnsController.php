<?php

namespace SuiviEnsBundle\Controller;

use Doctrine\ORM\EntityRepository;
use SuiviEnsBundle\Entity\Ens;
use CalendrierBundle\Entity\prof;
use SuiviEnsBundle\Entity\Suivi;
use SuiviEnsBundle\Form\SuiviType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Twilio\Rest\Client;


class SuiviEnsController extends Controller
{
    public function AjouterSuiviAction(Request $r)
    {

        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "ADMIN") {
                $suivi = new Suivi();
                $ens='a:1:{i:0;s:10:"ENSEIGNANT";}';
                $form = $this->createForm(SuiviType::class,$suivi)
                    ->add('ens', EntityType::class, [

                        'class' => \UserBundle\Entity\User::class,
                        'query_builder'=>function(EntityRepository $er) use($ens) {
                            return $er->createQueryBuilder('q')->where('q.roles like :x' )
                                ->setParameter('x','%'.$ens.'%');},
                        'choice_label' => 'nom'
                    ]);

                $form->handleRequest($r);
                if ($form->isSubmitted() AND $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $suivi->setDate(new \DateTime('now'));
                    if($suivi->getPresAbsc()=="Absent") {
                        $this->SMSAction();

                    }

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
        $ens='a:1:{i:0;s:10:"ENSEIGNANT";}';
        $form = $this->createFormBuilder($suivi)->add('presAbsc',ChoiceType::class, [
                'choices'  => [
                    'Présent' => 'Présent',
                    'Absent'  => 'Absent'

                ],
            ])  ->add('ens', EntityType::class, [

            'class' => \UserBundle\Entity\User::class,
            'query_builder'=>function(EntityRepository $er) use($ens) {
                return $er->createQueryBuilder('q')->where('q.roles like :x' )
                    ->setParameter('x','%'.$ens.'%');},
            'choice_label' => 'nom'
        ])
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
    public function SMSAction()
    {
        $account_sid = 'ACc59594be04ebd746aff5e04488ab8ce2';
        $auth_token = '6edb8fa78777ae7e92cad972270708dc';
        // In production, these should be environment variables. E.g.:
        // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

        // A Twilio number you own with SMS capabilities
        $twilio_number = "+12564884453";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
        // Where to send a text message (your cell phone?)
            '+21629138237',
            array(
                'from' => $twilio_number,
                'body' => 'Bonjour Monsieur /Madame , 
                je vous informes que vous etes absent ajourd hui ,
                 Priére d envoyer une justification de votre absence.Bonne journée '
            )
        );
    }
}
