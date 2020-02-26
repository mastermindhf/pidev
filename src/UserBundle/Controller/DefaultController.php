<?php

namespace UserBundle\Controller;
use CantineBundle\Entity\Notification;
use UserBundle\Entity\User;
use CoursBundle\Entity\Cours;
use CoursBundle\Entity\Wish;
use ClubBundle\Entity\Club;
use ClubBundle\Entity\Event;
use ClubBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
       $u=$this->container->get('security.token_storage')->getToken()->getUser();

            try {
                switch ($u->getRoles()[0]) {
                    case "ADMIN":
                        return $this->redirect('access/admin');
                        break;
                    case "PARENT":
                        return $this->redirect('access/parent');
                        break;
                    case "ELEVE":
                        return $this->redirect('access/eleve');
                        break;
                    case "ENSEIGNANT":
                        return $this->redirect('access/enseignant');
                        break;
                    case "CLUB":
                        return $this->redirect('access/club');
                        break;
                }
            } catch (\Throwable $e) {
                return $this->redirect('http://localhost/Pi-final/web/app_dev.php/login');

            };



    }






    public function adminAction()
    {   $user=$this->getUser();
        $user = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
        $notifs=$this->getDoctrine()->getRepository(Notification::class)->findAll();
        $x=count($notifs);

        return $this->render('@User/Default/admin.html.twig',['u'=>$user,'x'=>$x,'notifs'=>$notifs]);

    }


    public function parentAction()
    {
        return $this->render('@User/Default/parent.html.twig');

    }



    public function eleveAction()
    {   $user = $this->getUser();

        $w=$this->getDoctrine()->getRepository(Wish::class)->findMesCours();
        $Cours = $this->getDoctrine()->getRepository(Cours::class)->findAll();
        return $this->render('@User/Default/eleve.html.twig', array('Cours' => $Cours,'u'=>$user,'w'=>$w));

    }
    public function eleveeAction($id)
    {
        $eventd=$this->getDoctrine()->getRepository(Event::class)->find(array('id'=>$id));
        return $this->render('@User/Default/elevee.html.twig' ,array('eventd'=>$eventd));
    }

    public function eleveaAction($id)
    {
        $clubd=$this->getDoctrine()->getRepository(Club::class)->find(array('id'=>$id));
        return $this->render('@User/Default/elevea.html.twig' ,array('club'=>$clubd));
    }

    public function enseignantAction()
    {    $user = $this->container->get('security.token_storage')->getToken()->getUser()->getNom();
        return $this->render('@User/Default/enseignant.html.twig',['u'=>$user]);

    }
    public function clubAction()
    {
        return $this->render('@User/Default/club.html.twig');

    }
    public function homeAction()
    {
        return $this->render('@User/Default/home.html.twig');

    }



}
