<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Classes\Mail;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/inscription", name="register")
     */
    public function index(Cart $cart,Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $notif = null;

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if (!$search_email){
                $password = $encoder->hashPassword($user, $user->getPassword());
                $user->setPassword($password);
                
                $this->entityManager->persist($user);
                $this->entityManager->flush();
    
                $mail = new Mail();
                
                $client = $user->getFirstName();
                $message = "Vous pouvrez des a present vous connecter a votre compte perso, <br> Et Commencer a remplir votre panier afin d'effectuer votre premiere commande! <br>";
                $envoi = $user->getEmail();
                $sujet = "Bienvenue -  Inscription Reussie";
                $contenu = "Bonjour" . $client . ", <br> Bienvenue sur la boutique Web de la Boucherie Benoit Paux. <br>" . $message;
                $mail->send($envoi, $client, $sujet, $contenu);

                $notif = "Votre Inscription a bien été enregistrée, vous pouvez dorenavant vous connecter a votre compte perso";
            } else {
                $notif = "Un compte associé a cet email est deja existant!";
            }


        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull(),
            'notif' => $notif,
        ]);
    }
}
