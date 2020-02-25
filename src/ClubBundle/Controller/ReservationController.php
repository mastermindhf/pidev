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
            return $this->redirectToRoute('user_eleve');
        }
        else
        {
            return $this->redirectToRoute('user_eleve');
        }
        return $this->render('@Club/Event/afficher.html.twig');
    }
}
