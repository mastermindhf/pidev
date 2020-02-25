<?php

namespace CantineBundle\Controller;

use AdministrationBundle\Entity\etudiant;

use CantineBundle\Entity\Notification;
use Symfony\Component\HttpFoundation\Response;
use CantineBundle\Entity\AvisNegatif;
use CantineBundle\Entity\AvisPlat;
use CantineBundle\Entity\Dessert;
use CantineBundle\Entity\Jourdelasemaine;
use CantineBundle\Entity\Menu;
use CantineBundle\Entity\Plat;
use CantineBundle\Entity\Semaine;
use CantineBundle\Form\DessertType;
use CantineBundle\Form\PlatType;
use Doctrine\DBAL\Types\TextType;

use \Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Tests\ResponseFunctionalTest;
use UserBundle\Entity\User;

class CantineController extends Controller
{
    public function ajouterPlatAction(Request $req)
    {
        $notifs=$this->getDoctrine()->getRepository(Notification::class)->findAll();
        $x=count($notifs);

        $eleve = $this->getDoctrine()->getRepository(etudiant::class)->findAll();
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);

        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($eleve as $user) {
                $usr = $user->getMail();
                $message = (new \Swift_Message('Schoolnet'))
                    ->setFrom('wejdene.benjeddou@esprit.tn')
                    ->setTo($usr)
                    ->setBody(
                        $this->renderView(
                        // app/Resources/views/Emails/registration.html.twig
                            '@Cantine/cantine/mail.html.twig'
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($message);
            }
            $plat->setLikes(0);
            $plat->setDislikes(0);
            $plat->setRes(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();

        }
        return $this->render('@Cantine/Cantine/ajouter_plat.html.twig', array('form' => $form->createView()
        , 'notifs'=>$notifs, 'x'=>$x
        ));
    }

    public function afficherPlatAction()
    {

        $notifs=$this->getDoctrine()->getRepository(Notification::class)->findAll();
        $x=count($notifs);

        $plats = $this->getDoctrine()->getRepository(Plat::class)->findAll();
        $avis = $this->getDoctrine()->getRepository(AvisPlat::class)->findAll();
        $negatif = $this->getDoctrine()->getRepository(AvisNegatif::class)->findAll();

        $user = $this->getUser();
        return $this->render('@Cantine/Cantine/afficher_plat.html.twig', array('p' => $plats, 'avis' => $avis,
            'u' => $user, 'negatif' => $negatif,
            'notifs'=>$notifs,'x'=>$x
        ));
    }

    public  function  traiterNotifAction($plat)

    {

        $notif = $this->getDoctrine()->getRepository(Notification::class)->findnotif($plat);
        $en=$this->getDoctrine()->getManager();
        $en->flush();
        return $this->redirectToRoute('afficher_plat');

    }

    public function afficherPlat_frontAction()
    {
        $plats = $this->getDoctrine()->getRepository(Plat::class)->findAll();
        $avis=  $this->getDoctrine()->getRepository(AvisPlat::class)->findAll();
        $negatif=  $this->getDoctrine()->getRepository(AvisNegatif::class)->findAll();

        $user=$this->getUser();
        return $this->render('@Cantine/Cantine/afficher_plat_front.html.twig', array('p' => $plats,'avis'=>$avis,'u'=>$user,'negatif'=>$negatif
        ));
    }

    public function modifierPlatAction($id,Request $r)
    {
        $plat = $this->getDoctrine()->getRepository(Plat::class)->find($id);
        $form = $this->createFormBuilder($plat)->add('Libelle')->add('description')->add('Modifier', SubmitType::class)->getForm();
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('afficher_plat');
        }
        return $this->render('@Cantine/Cantine/modifier_plat.html.twig',array('form' => $form->createView()
            // ...
        ));
    }
    public function modifierMenuAction($id,Request $r)
    {
        $menu = $this->getDoctrine()->getRepository(Menu::class)->find($id);

        $form = $this->createFormBuilder($menu)

            ->add('plat', EntityType::class, [

                'class' => plat::class,
                'choice_label' => 'libelle'
            ])  ->add('dessert', EntityType::class, [

                'class' => Dessert::class,
                'choice_label' => 'libelle'
            ])->add('Modifier', SubmitType::class)->getForm();

        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('afficherMenuNormal');
        }
        return $this->render('@Cantine/Cantine/modifier_menu.html.twig',array('f' => $form->createView()
            // ...
        ));
    }

    public function supprimerPlatAction($id)
    {

        $plat = $this->getDoctrine()->getRepository(Plat::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($plat);
        $em->flush();
        return $this->redirectToRoute('afficher_plat');
    }


    public  function  creerMenuAction(Request $req )
    {
        $menu = new Menu();
        $form2 = $this->createFormBuilder($menu)->add('ajouter quand meme',SubmitType::class)
            ->getForm();

        $form2->handleRequest($req);


        $today = date("d.m.y");
        $msg='';

        $nw= date('d.m.y',strtotime('+1week'));

        $plat = new plat();
        $form = $this->createFormBuilder($menu)

            ->add('semaine', EntityType::class,[
                    'class' => Semaine::class,

                    'choice_label' => 'libelle'

                ]
            )


            ->add('jour', EntityType::class, [
                    'class' => Jourdelasemaine::class,
                    'choice_label' => 'libelle'
                ]
            )
            ->add('plat', EntityType::class, [

                'class' => plat::class,
                'choice_label' => 'libelle'
            ])
            ->add('dessert', EntityType::class, [

                'class' =>Dessert::class,
                'choice_label' => 'libelle'
            ])

            ->add('ajouter', SubmitType::class)
            ->getForm();

        $form->handleRequest($req);
        $menu->setCalories(0);



        /**********************************************************************************************************************/
        if ($form->isSubmitted() AND $form->isValid()) {

            $p = $form['plat']->getData();
            $servi=$this->getDoctrine()->getRepository(Menu::class)->findByPlat($p);
            $em = $this->getDoctrine()->getManager();

if($servi==null) {

    $em->persist($menu);
    $em->flush();

}

else
{
   $msg='plat déja servi cette semaine';
}

if($form2->isSubmitted())
{
    $em->persist($menu);
    $em->flush();
}

        }


        return $this->render('@Cantine\Cantine\creer_menu.html.twig', array("f" => $form->createView(),"d"=>$today,"nw"=>$nw,"msg"=>$msg,
            "f2"=>$form2->createView()

            // ...
        ));
    }


    public function afficherMenuAction()
    {
        $em = $this->getDoctrine()->getManager();

        $p=$this->getDoctrine()->getRepository(Menu::class)->findAll();
        return $this->render('@Cantine/Cantine/afficher_menu.html.twig', array("e"=>$p));


    }
    public function afficherMenuFrontAction()
    {
        $em = $this->getDoctrine()->getManager();

        $p=$this->getDoctrine()->getRepository(Menu::class)->findAll();
        return $this->render('@Cantine/Cantine/afficher_menu_front.html.twig', array("e"=>$p));


    }
    public function afficherMenuNormalAction()
    {
        $em=$this->getDoctrine()->getManager();
        $nw= date('yy.mm.dd',strtotime('week'));
        $p=$this->getDoctrine()->getRepository(Menu::class)->findAll();

        foreach ($p as $item) {
            $item->setCalories($item->getPlat()->getCalories()+$item->getDessert()->getCalories());

        }
        $em->flush();

        return $this->render('@Cantine/Cantine/afficher_menu_normal.html.twig', array("e"=>$p,"nw"=>$nw));


    }

    public function ajouterDessertAction(Request $req)
    {
        $dessert = new Dessert();
        $form = $this->createForm(DessertType::class, $dessert);
        $form->add('Ajouter', SubmitType::class);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dessert);
            $em->flush();

        }
        return $this->render('@Cantine/Cantine/ajouter_dessert.html.twig', array('f' => $form->createView()
            // ...
        ));
    }

    function  supprimerMenuAction($id)
    {
        $menu = $this->getDoctrine()->getRepository(Menu::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($menu);
        $em->flush();
        return $this->redirectToRoute('afficherMenuNormal');
    }

    function calculerCalorieAction($id)
    {
        $ligneMenu = $this->getDoctrine()->getRepository(Menu::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $ligneMenu->setCalories($ligneMenu->getPlat()->getCalories()+$ligneMenu->getDessert()->getCalories());
        $em->flush();


        return $this->render('@Cantine/Cantine/calculer.html.twig', array('ligne' => $ligneMenu
            // ...
        ));
    }

    public function aimerAction($id)
    {
        $avis = new AvisPlat();
        $user = $this->getUser()->getId();
        $plat = $this->getDoctrine()->getRepository(Plat::class)->find($id);
        $plat->setLikes($plat->getLikes() + 1);
        if ($plat->getDislikes() != 0) {
            $plat->setDislikes($plat->getDislikes() - 1);
        }
        $plat->setRes($plat->getLikes() - $plat->getDislikes());
        $avis->setPlat($plat);
        $avis->setIdeleve($user);

        $em = $this->getDoctrine()->getManager();
        $em->persist($avis);
        $em->flush();

        $dislike = $this->getDoctrine()->getRepository(AvisNegatif::class)->findvote($user, $plat);

        $notif=new Notification();

        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $notif->setUser($u->getUsername());
        $notif->setPlat($plat);
        $notif->setMessage("halo");
        $en=$this->getDoctrine()->getManager();
        $en->persist($notif);
        $en->flush();
        return $this->redirectToRoute('afficher_plat_front');

    }

    public function dislikeAction($id)
    {
        $avis = new AvisNegatif();
        $user = $this->getUser()->getId();
        $plat = $this->getDoctrine()->getRepository(Plat::class)->find($id);
        $plat->setDislikes($plat->getDislikes() + 1);
        if ($plat->getLikes() != 0) {
            $plat->setLikes($plat->getLikes() - 1);
        }
        $avis->setPlat($plat);
        $avis->setIdeleve($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($avis);
        $em->flush();

        $like = $this->getDoctrine()->getRepository(AvisPlat::class)->findvote($user, $plat);


        return $this->redirectToRoute('afficher_plat_front');

    }
    public function mailAction()
    {    $eleve=$this->getDoctrine()->getRepository(etudiant::class)->findAll();

        foreach($eleve as $user){
            $usr=$user->getMail();
            $message = (new \Swift_Message('nouveau plat'))
                ->setFrom('wejdene.benjeddou@esprit.tn')
                ->setTo($usr)
                ->setBody(
                    $this->renderView(
                    // app/Resources/views/Emails/registration.html.twig
                        '@Cantine/cantine/mail.html.twig'
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);
        }





        // or, you can also fetch the mailer service this way
        // $this->get('mailer')->send($message);

        return $this->redirectToRoute('afficher_plat');
    }



    public function topPlatAction(){
        $notifs=$this->getDoctrine()->getRepository(Notification::class)->findAll();
        $x=count($notifs);
        $top=$this->getDoctrine()->getRepository(Plat::class)->findTop();
        return $this->render('@Cantine/Cantine/top_plat.html.twig', array('top' => $top , 'notifs'=>$notifs, 'x'=>$x
            // ...
        ));

    }


}

