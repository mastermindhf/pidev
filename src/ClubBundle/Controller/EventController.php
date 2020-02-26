<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Event;
use ClubBundle\Form\EventType;
use Composer\DependencyResolver\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class EventController extends Controller
{
    public function AjouterAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $event=new Event();
        $form=$this->createForm(EventType::class,$event)
            ->add('photo',FileType::class,array('label'=>'photo'));
        $form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            //$valid =1;
            //die('here');
            /**
             * @var UploadedFile $file
             */
            $file=$event->getPhoto();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName);
            $event->setPhoto($fileName);

            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('_afficherEvent');
        }
        return $this->render('@Club/Event/ajouter.html.twig',
            array('event'=>$event,'f'=>$form->createView()));
    }

    public function ModifierAction(\Symfony\Component\HttpFoundation\Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository(Event::class)
            ->find($id);
        $form=$this->createForm(EventType::class,$event) ->add('photo',FileType::class,array('label'=>'photo','data_class'=>null, 'required'=>false));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file=$event->getPhoto();
            $fileName=md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName);
            $event->setPhoto($fileName);
            $em->flush();
            return $this->redirectToRoute('_afficherEvent');
        }
        return $this->render('@Club/Event/modifier.html.twig', array(
            'event'=>$event,'f'=>$form->createView()));
    }

    public function AfficherAction()
    {
        $event=$this->getDoctrine()->getRepository(Event::class)->findAll();
        return $this->render('@Club/Event/afficher.html.twig',
            array('event'=>$event));
    }

    public function SupprimerAction($id){
        $em=$this->getDoctrine()->getManager();
        $event=$em->getRepository(Event::class)
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('_afficherEvent');
    }

    public function AfficherEventIDAction($id)
    {
        $event=$this->getDoctrine()->getRepository(Event::class)->find(array('id'=>$id));
        return $this->render('@Club/Event/afficherEvent.html.twig',
            array('event'=>$event));
    }

    public function AfficherEventFrontAction(){
        $event=$this->getDoctrine()->getRepository(Event::class)->findAll();
        return $this->render('@Club/Event/afficherEventFront.html.twig',
            array('event'=>$event));
    }

    public function AfficherEventIDFrontAction($id)
    {
        $event=$this->getDoctrine()->getRepository(Event::class)->find(array('id'=>$id));
        return $this->render('@Club/Event/afficherEvent.html.twig',
            array('event'=>$event));
    }
}
