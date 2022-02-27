<?php

namespace App\Controller;

use App\Classes\Mail;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request): Response
    {
        $notif = null;

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$this->addFlash('notice', 'Merci de nous avoir contacté, notre equipe va vous repondre dans les plus brefs delais!');

            $prenom =$form['firstname']->getData(); 
            $nom = $form['lastname']->getData();
            $contact = $form['email']->getData();
            $sujet = $form['subject']->getData();
            $contenu = $form['content']->getData();

            if ($sujet === 'Client'){
            
                $mail = new Mail();
                
                $client = $prenom . " " . $nom;
                $envoi = "webtestprojet@gmail.com";
                $shop = "Benoit Paux";
                $sujet = "Nouveau Message Service Client";
                $message = $client . "viens de vous contacter <br> il souhaite que vous le recontactiez a cette adresse:" . $contact . "<br> Voici la copie de son message <br>" . $contenu;
                $mail->send($envoi, $shop, $sujet, $message);

                $this->addFlash('notice', 'Merci d\'avoir contacté le service clients, notre equipe va vous repondre dans les plus brefs delais!');

                //$notif = "Votre Message a bien été envoyé au Service Client";
            
            }   
                elseif ($sujet === 'Admin') {

                    $mail = new Mail();
                
                    $client = $prenom . " " . $nom;
                    $envoi = "webtestprojet@gmail.com";
                    $shop = "WebMaster";
                    $sujet = "Nouveau Message WebMaster";
                    $message = $client . "viens de vous contacter <br> il souhaite que vous le recontactiez a cette adresse:" . $contact . "<br> Voici la copie de son message <br>" . $contenu;
                    $mail->send($envoi, $shop, $sujet, $message);

                    $this->addFlash('notice', 'Merci d\'avoir contacté le WebMaster, une fois le probleme réglé il vous repondra dans les plus brefs delais!');

                    //$notif = "Votre Message a bien été envoyé au WebMaster";
                }
                    else {
                        $this->addFlash('notice', 'Une erreur est survenue, votre message n\'a pas pu etre envoyé!');
                        //$notif = "Une Erreur est survenue et votre message n'a pas été envoyé!";
                    }
            
        }

        return $this->render('contact/index.html.twig', [
            'form'=>$form->createView(),
            //'notif' => $notif,
        ]);
    }
}