<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Club;
use ClubBundle\Entity\Mail;
use ClubBundle\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{
    public function sendMailAction(Request $request,$id)
    {
        $mail = new Mail();
        $form = $this->createForm(MailType::class, $mail);
        //$c=$this->getDoctrine()->getRepository(Club::class)->find($id);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $subject = $mail->getSubject();
            $mail = $mail->getMail();
            $objet = $request->get('form')['objet'];
            $username ='elyes.tarmiz@esprit.tn';
            $message = \Swift_Message::newInstance()
                ->setBody('ok')
                ->setFrom('elyes.tarmiz@esprit.tn')
                ->setTo('elyes.tarmiz@esprit.tn')
                ->setSubject('ok');
            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->add('notice','Your email was sent successfully !');
        }
        return $this->render('@Club/Event/mail.html.twig', array('f' => $form->createView()/*,'c'=>$c*/));
    }
}
