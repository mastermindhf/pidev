<?php

namespace BiblioBundle\Controller;

use BiblioBundle\Entity\Reservationlivre;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use BiblioBundle\Entity\Livres;
use BiblioBundle\Form\LivresType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BiblioBundle\Repository\ReservationlivreRepository;

class LivresController extends Controller
{
    public function AjoutLivreAction(Request $request)
    {
        $user=$this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0]=="ADMIN"){
                //1-form
                //1-a:objet vide
                $livre=new Livres();
                //1-b:create form
                $form=$this->createForm(LivresType::class,$livre)
                    ->add('image',FileType::class,array('label'=>'Image'));
                //2-les données
                $form=$form->handleRequest($request);
                $nom=$livre->getNom();
                $auteur=$livre->getAuteur();
                $nbpersonnes=$livre->getNbpersonnes();
                $quantite=$livre->getQuantite();
                $description=$livre->getDescription();

                if($form->isSubmitted())
                {

                    //$valid =1;
                    //die('here');
                    /**
                     * @var UploadedFile $file
                     */
                    $file=$livre->getImage();
                    $fileName=md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($this->getParameter('image_directory'),$fileName);
                    $livre->setImage($fileName);
                    //3-cnx avec BD
                    $em=$this->getDoctrine()->getManager();
                    $em->persist($livre);
                    $em->flush();
                    return $this->redirectToRoute('AfficheLivre');
                }

                //1-c:envoi du form
                return $this->render('@Biblio/Livres/AjoutLivre.html.twig', array(
                    "f"=>$form->createView()
                ));
            }
            else{
                return $this->redirectToRoute("fos_user_security_login");

            }
        }

        else{
            return $this->redirectToRoute("fos_user_security_login");

        }
    }


    public function AfficheLivreAction(Request $request)
    {
        //les donnée de bdd
        $livre=$this->getDoctrine()
            ->getRepository(Livres::class)
            ->findAll();
        //pagination
        /* $pagination  = $this->get('knp_paginator')->paginate(
             $livre,
             $request->query->get('page', 1) le numéro de la page à afficher,
             3 nbre d'éléments par page*/
        //affichage
        return $this->render("@Biblio/Livres/AfficheLivre.html.twig", array("list"=>$livre));
    }

    public function AfficheLivreFAction(Request $request)
    {
        //les donnée de bdd
        $livre=$this->getDoctrine()
            ->getRepository(Livres::class)
            ->findAll();
        //pagination
        /* $pagination  = $this->get('knp_paginator')->paginate(
             $livre,
             $request->query->get('page', 1) le numéro de la page à afficher,
             3 nbre d'éléments par page*/
        //affichage
        return $this->render("@Biblio/LivresFront/AfficheLivre.html.twig", array("list"=>$livre));
    }


    function UpdateLivreAction(Request $request,$id){
        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ADMIN') {
                $em = $this->getDoctrine()->getManager();
                $livre = $this->getDoctrine()
                    ->getRepository(Livres::class)
                    ->find($id);
                $Form = $this->createForm(LivresType::class, $livre);
                $Form->handleRequest($request);

                if ($Form->isSubmitted()) {
                    $em->flush();
                    return $this->redirectToRoute('AfficheLivre');

                }
                return $this->render('@Biblio/Livres/UpdateLivre.html.twig',
                    array('f' => $Form->createView()));
            }
            else
            {
                return $this->redirectToRoute('fos_user_security_login');
            }
        }
        else
        {
            return $this->redirectToRoute('fos_user_security_login');
        }
    }

    function DeleteLivreAction($id){
        $em=$this->getDoctrine()->getManager();
        $livre=$this->getDoctrine()->getRepository(Livres::class)
            ->find($id);
        $em->remove($livre);
        $em->flush();
        return $this->redirectToRoute('AfficheLivre');
    }



    public function getLivreAction($idLivre){
        $em = $this->getDoctrine()->getManager();
        $livre=$em->getRepository(Livres::class)->findOneByIdLivre($idLivre);

        $user = $this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0] == 'ELEVE')
            {
                $idUser = $user->getId();
                //$idEvent = $event->getIdevent();
                //die('id event'.$idEvent);
                $verify = $this->getDoctrine()
                    ->getRepository(Reservationlivre::class)
                    ->myfindMe($idUser, $idLivre);

                if($verify == null)
                {
                    $error = 1;
                }

                else
                {
                    $error = 2;
                }
                return $this->render('@Biblio/LivresFront/getLivre.html.twig', array(
                    "list"=>$livre,
                    'error' => $error
                ));
            }

            else
                return $this->redirectToRoute('AfficheLivreF');
        }
        return $this->redirectToRoute('fos_user_security_login');


    }


    public function  ReservationLivreAction(Request $request,$idLivre )
    {
        $user = $this->getUser();

        if($user != null)
        {
            if($user->getRoles()[0] == 'ELEVE')
            {
                $idUser = $user->getId();
                //$idEvent = $event->getIdevent();
                //die('id event'.$idEvent);
                $verify = $this->getDoctrine()
                    ->getRepository(Reservationlivre::class)
                    ->myfindMe($idUser, $idLivre);

                if($verify == null)
                {
                    $error = 1;
                    $reservation = new Reservationlivre();
                    $reservation->setIdeleve($idUser);
                    $reservation->setIdlivre($idLivre);
                    //die($idUser. ' ra: ' . $idRando);
                    $em = $this->getDoctrine()->getManager();
                    //updating place available in randonne table
                    $nbPersonnes = $em->getRepository(Livres::class)->findOneByidLivre($idLivre);
                    $quantite = $em->getRepository(Livres::class)->findOneByidLivre($idLivre);

                    $qte=$quantite->getQuantite();
                    $nb = $nbPersonnes->getNbpersonnes();
                    if($nb == null)
                    {
                        $nb = 0;
                    }
                    //die('nn: '.$nbrePersonnes->getCapevent().' nbtr: '.$nbre);

                    //verification of number of inscriptions vs capacity
                    if(((int)$nbPersonnes->getQuantite()) > (int)$nb )
                    {
                        $new = (int)$nb+1;
                        $newqte = (int)$qte-1;
                        //
                        $nbPersonnes->setNbpersonnes($new);
                        $quantite->setQuantite($newqte);
                        //$event->setNbrepersonnes($new);
                        //die('nbre actuel: '.$nbrClient[0]->getNbreclient().' new one: '.$new );
                        //die('success');
                    }
                    else
                    {
                        $error = 2;
                    }
                    //Saving in new data DB

                    $em->persist($reservation);
                    $em->flush();
                    return $this->redirectToRoute('AfficheLivre');
                }

                else
                {
                    $error = 2;
                    return $this->redirectToRoute('AfficheLivre', array(
                        'error' => $error
                    ));
                }
            }
            else
                return $this->redirectToRoute('AfficheLivreF');
        }
        return $this->redirectToRoute('fos_user_security_login');
    }

    public function RendreLivreAction($idLivre)
    {
        //die('id: '.$randonne->getIdrando())
        //die("here");
        $user = $this->getUser();
        if($user != null)
        {
            $idUser = $user->getId();
            //$idEvent = $event->getIdevent();

            $em = $this->getDoctrine()->getManager();
            $reservation =$em->getRepository(Reservationlivre::class)->myFindMe($idUser,$idLivre);
            $em->remove($reservation[0]);

            $nbPersonnes = $em->getRepository(Livres::class)->getAllAboutLivre($idLivre);
            $qte=$em->getRepository(Livres::class)->getAllAboutLivre($idLivre);
            //die('nb '.);
            $livre = $this->getDoctrine()->getRepository(Livres::class)->find($idLivre);
            $new = $nbPersonnes[0]->getNbpersonnes()-1;
            $newqte = $qte[0]->getQuantite()+1;
            //die('new '.$new);
            $livre->setNbpersonnes($new);
            $livre->setQuantite($newqte);
            //die('new : '.$randonne->getNbclient());
            $this->getDoctrine()->getManager()->flush();
            $em->flush();
            return $this->redirectToRoute('AfficheLivreF');
        }
        else
            return $this->redirectToRoute('fos_user_security_login');
    }

    public function reserveReadByUserAction(Request $request)
    {
        $user=$this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0]!="ROLE_ELEVE") {
                $idc=$user->getId();
                $reservation=$this->getDoctrine()->getRepository(Reservationlivre::class)->findByUser($idc);
                return $this->render("@Biblio/LivresFront/ReadMyReservation.html.twig", array("list"=>$reservation));
            }
            else
            {return $this->redirectToRoute("fos_user_security_login");}
        }
        return $this->redirectToRoute("fos_user_security_login");
    }

}

