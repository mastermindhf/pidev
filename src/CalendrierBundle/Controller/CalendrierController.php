<?php

namespace CalendrierBundle\Controller;
use CalendrierBundle\Entity\Calendrier;
use CalendrierBundle\Entity\Classe;
use CalendrierBundle\Entity\Emploi;
use CalendrierBundle\Entity\Heure;
use CalendrierBundle\Entity\Jour;
use CalendrierBundle\Entity\prof;
use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\User;
use \Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;

class CalendrierController extends Controller
{
    public function creerEmploiAction(Request $req)
    {
        $msg = '';
        $r = '';
        $ens='a:1:{i:0;s:10:"ENSEIGNANT";}';
        $emploi = new Calendrier();
        $pr = new prof();
        $form = $this->createFormBuilder($emploi)
            ->add('prof', EntityType::class, [

                'class' => \UserBundle\Entity\User::class,
                'query_builder'=>function(EntityRepository $er) use($ens) {
                return $er->createQueryBuilder('q')->where('q.roles like :x' )
                    ->setParameter('x','%'.$ens.'%');},
                'choice_label' => 'nom'
            ])
            ->add('Jour', EntityType::class, [

                    'class' => Jour::class,
                    'choice_label' => 'libelle'
                ]


            )
            ->add('Heure', EntityType::class, [

                    'class' => Heure::class,
                    'choice_label' => 'libelle'
                ]


            )->add('Classe', EntityType::class, [

                'class' =>\SuiviBundle\Entity\Classe::class,
                'choice_label' => 'libelle'
            ])
            ->add('ajouter', SubmitType::class)
            ->getForm();

        $form->handleRequest($req);
        /**********************************************************************************************************************/
        if ($form->isSubmitted() AND $form->isValid()) {
            $p = $form['prof']->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($emploi);
            $em->flush();
            $x = $p->getId();
            $r = $this->getDoctrine()->getRepository(prof::class)->find($x);




        }

        return $this->render('@Calendrier\Calendrier\creer_emploi.html.twig', array("f" => $form->createView(), "msg" => $msg, "r" => $r

            // ...
        ));

    }


    public function afficherEmploiAction($id)
    {
        $rep = $this->getDoctrine()->getRepository(Calendrier::class)->findByProf($id);
        $p=$this->getDoctrine()->getRepository(Calendrier::class)->findOneByProf($id);

        return $this->render('@Calendrier/Calendrier/afficher_emploi.html.twig', array("e" => $rep ,"p"=>$p));




    }
    public function afficherClasseAction()
    {           $user=$this->getUser()->getClasse();

        $usr=$this->getDoctrine()->getRepository(Calendrier::class)->findOneByClasse($user);



        return $this->render('@Calendrier/Calendrier/afficher_emploi_classe.html.twig', array("e" => $usr));


    }

    public function afficherEmploiClasseAction($id)
    {
        $rep = $this->getDoctrine()->getRepository(Calendrier::class)->findByClasse($id);
        $p=$this->getDoctrine()->getRepository(Calendrier::class)->findOneByClasse($id);

        return $this->render('@Calendrier/Calendrier/afficher_emploi_classe.html.twig', array("e" => $rep ,"p"=>$p));




    }

    public function afficherProfAction()
    {

        $e = $this->getDoctrine()->getRepository(\UserBundle\Entity\User::class)->findEns();



        return $this->render('@Calendrier/Prof/afficher_prof.html.twig', array("e" => $e));


    }


    public function afficherEmploiNormalAction($id)
    {

        $rep = $this->getDoctrine()->getRepository(Calendrier::class)->mfind($id);
        $p = $this->getDoctrine()->getRepository(Calendrier::class)->findOneByProf($id);
        if ($p != null) {
            return $this->render('@Calendrier/Calendrier/normal.html.twig', array("e" => $rep, 'p' => $p));
        }

return $this->render('@Calendrier/Calendrier/vide.html.twig');

    }



    public function ModifierEmploiAction($id, Request $r)
    {
        $emploi = $this->getDoctrine()->getRepository(Emploi::class)->find($id);
        $form = $this->createFormBuilder($emploi)

            ->add('prof', EntityType::class, [

                'class' => prof::class,
                'choice_label' => 'nom'
            ])

            ->add('jour', EntityType::class, [

                    'class' => Jour::class,
                    'choice_label' => 'libelle'
                ]


            )
            ->add('heure', EntityType::class, [

                    'class' => Heure::class,
                    'choice_label' => 'libelle'
                ]


            )->add('Classe', EntityType::class, [

                'class' => Classe::class,
                'choice_label' => 'libelle'
            ])
            ->add('modifier', SubmitType::class)
            ->getForm();
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
          //  return $this->redirectToRoute('afficherEmploiNormal{id}');
        }
        return $this->render('@Calendrier/Calendrier/modifier_emploi.html.twig', array('form' => $form->createView()
            // ...
        ));
    }

    public function SupprimerEmploiAction($id)
    {
        $emploi = $this->getDoctrine()->getRepository(Calendrier::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($emploi);
        $em->flush();
        return $this->redirectToRoute('afficherProf');

    }


}
