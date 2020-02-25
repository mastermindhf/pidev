<?php

namespace RecBundle\Controller;

use Doctrine\ORM\EntityRepository;
use RecBundle\Entity\recparent;
use RecBundle\Form\recparentType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class RecController extends Controller
{
    public function AjoutAction(Request $request)
    {
        $user = $this->getUser();
        if ($user != null) {
            if ($user->getRoles()[0] == "PARENT") {
                $reclamation = new recparent();

                $ens="a:1:{i:0;s:6:\"PARENT\";}";
                $form = $this->createForm(recparentType::class, $reclamation)
                    ->add('parent', EntityType::class, [

                        'class' => \UserBundle\Entity\User::class,
                        'query_builder'=>function(EntityRepository $er) use($ens) {
                            return $er->createQueryBuilder('q')->where('q.roles like :x' )
                                ->setParameter('x','%'.$ens.'%');},
                        'choice_label' => 'nom'
                    ]);
                ;
                $form->handleRequest($request);
                $form1 = $form->createView();

                if ($form->isSubmitted()) {
                    $em = $this->getDoctrine()->getManager();
                    $reclamation->setParent($user);
                    $em->persist($reclamation);
                    $em->flush();
                    return $this->redirectToRoute('_affiche');

                }
                return $this->render('@Rec/Default/ajout.html.twig', array('f' => $form1,'user'=>$user));

            }

        }
        return $this->redirectToRoute("fos_user_security_login");
    }
    function AfficheAction()
    { $user=$this->getUser();
        $rec= $this->getDoctrine()->getRepository(recparent::class)->findBy(['parent'=>$user]);

        return $this->render('@Rec/Default/Affiche.html.twig', array('c' => $rec,'usr'=>$user));
    }

    function AfficheAdminAction()
    {
        $rec= $this->getDoctrine()->getRepository(recparent::class)->findAll();

        return $this->render('@Rec/Default/AfficheAdmin.html.twig', array('c' => $rec));
    }

    public function SupprimerRecAction($id)
    {
        $rec = $this->getDoctrine()->getRepository(recparent::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($rec);
        $em->flush();
        return $this->redirectToRoute('_affiche');

    }
    public function ModifierRecAction($id, Request $r)
    {
        $rec = $this->getDoctrine()->getRepository(recparent::class)->find($id);
        $form = $this->createFormBuilder($rec)->add('message',TextareaType::class)->add('Modifier', SubmitType::class)->getForm();
        $form->handleRequest($r);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('_affiche');
        }
        return $this->render('@Rec/Default/modifierRec.html.twig', array('form' => $form->createView()
            // ...
        ));
    }
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $rec =  $em->getRepository('RecBundle:parentrec')->find($requestString);
        if(!$rec) {
            $result['rec']['error'] = "Post Not found :( ";
        } else {
            $result['id'] = $rec->getId();
            $result['nom'] = $rec->getNom();


        }
        return new Response(json_encode($result));
    }
    public function impAction()
    {
        $rec= $this->getDoctrine()->getRepository(recparent::class)->findAll();


        return $this->render('@Rec/Default/imp.html.twig', array(
            'c' => $rec,
        ));
    }
}
