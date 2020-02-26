<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Event;
use ClubBundle\Entity\Reservation;
use ClubBundle\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reservation controller.
 *
 * @Route("reservation")
 */
class ReservationController extends Controller
{
    public function ReserverAction($id)
    {
        $res=new Reservation();
        $event=$this->getDoctrine()->getRepository(Event::class)->find($id);
        $nbp=$event->getNbPlaces()-1;
        $event->setNbPlaces($nbp);
        if($nbp!=0)
        {
            $res->setIdEvent($event);
            $em=$this->getDoctrine()->getManager();
            $em->persist($res);
            $em->flush();
            return $this->redirect('http://localhost/Pi-final/web/app_dev.php/access/elevee/'.$id);
        }
        else
        {
            return $this->redirect('http://localhost/Pi-final/web/app_dev.php/access/elevee/'.$id);
        }
    }
    public function AfficheReservationAction()
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $reservation= $this->getDoctrine()->getRepository(Reservation::class)->findBy(array('idUser'=>$usr));
        return $this->render('@Club/Reservation/afficherReservation.html.twig', array(
            'reservation' => $reservation
        ));
    }

    public function ConfirmerAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $res=$this->getDoctrine()->getRepository(Reservation::class)->find($id);
        if($res->getEtat()=='annulé')
        {
            $this->addFlash("error","Votre reservation a été déja annulée");
        }
        else
        {
            $res->setEtat('confirmé');
            $em->flush();
        }
        return $this->redirectToRoute('_afficherRes');
    }

    public function AnnulerAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $res=$this->getDoctrine()->getRepository(Reservation::class)->find($id);
        $res->setEtat('annulé');
        $reser=$this->getDoctrine()->getRepository(Reservation::class)->findAll();
        $em->flush();
        return $this->redirectToRoute('_afficherRes');
    }
    public function AfficheReservationBackAction()
    {
        $usr= $this->get('security.token_storage')->getToken()->getUser();
        $reservation= $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        return $this->render('@Club/Reservation/afficherReservationBack.html.twig', array(
            'reservation' => $reservation
        ));
    }
}
