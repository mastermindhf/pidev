<?php

namespace BiblioBundle\Controller;

use BiblioBundle\Entity\Type;
use BiblioBundle\Form\TypeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class TypeController extends Controller
{
    function AjouttypeAction(Request $request){
        $type=new Type();
        $Form=$this->createForm(TypeType::class,$type);
        $Form->handleRequest($request);
        //$club->setSujet(null);
        if($Form->isSubmitted() && $Form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();
            return $this->redirectToRoute('AfficheType');

        }
        return $this->render('@Biblio/Type/AjoutType.html.twig',
            array('f'=>$Form->createView()));
    }


    function AfficheTypeAction(){
        $type=$this->getDoctrine()
            ->getRepository(Type::class)
            ->findAll();
        return $this->render('@Biblio/Type/AfficheType.html.twig',
            array('c'=>$type));
    }

    function UpdateAction(Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $type=$this->getDoctrine()
            ->getRepository(Type::class)
            ->find($id);
        $Form=$this->createForm(TypeType::class,$type);
        $Form->handleRequest($request);
        if($Form->isSubmitted() && $Form->isValid()){
            $em->flush();
            return $this->redirectToRoute('AfficheType');

        }
        return $this->render('@Biblio/Type/Update.html.twig',
            array('f'=>$Form->createView()));
    }

    function DeleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $type=$this->getDoctrine()->getRepository(Type::class)
            ->find($id);
        $em->remove($type);
        $em->flush();
        return $this->redirectToRoute('AfficheType');
    }

}
