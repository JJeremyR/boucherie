<?php

namespace App\Controller;

use App\Classes\Mail;
use App\Entity\ResetPassword;
use App\Entity\User;
use App\Form\ResetPasswordType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/reinitialisation-mot-de-passe", name="reset_password")
     */
    public function index(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        if ($request->get('email')) {
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));

            if ($user) {
                $reset_password = new ResetPassword();
                $reset_password->setUser($user);
                $reset_password->setToken(uniqid());
                $reset_password->setCreatedAt(new DateTime());
                $this->entityManager->persist($reset_password);
                $this->entityManager->flush();

                $mail = new Mail();
                $envoi = $user->getEmail();
                $client = $user->getFullName();
                $url = $this->generateUrl('update_password', [
                    'token' => $reset_password->getToken()
                ]);

                $sujet = "Réinitialisation de votre mot de passe - Boucherie Benoit Paux";
                $message1 = "Vous nous avez demandé la reinitialisation de votre mot de passe sur la boutique de la Boucherie Benoit Paux.";
                $message2 = "Pour ce faire, merci de bien vouloir cliquer sur le lien ci dessous afin de ";
                $lien = "<a href='" . $url . "'>mettre a jour votre mot de passe</a>";
                $contenu = "Bonjour " . $client . ",<br>" . $message1 . "<br>" . $message2 . "<br>" . $lien . "<br>";

                $mail->send($envoi, $client, $sujet, $contenu);

                $this->addFlash('notice', 'Un email avec la procedure de réinitialisation de votre mot de passe vient de vous etre envoyé.');
            } 
            else{
                $url2 = $this->generateUrl('register');
                $lien = "<a href='" . $url2 . "'>ce lien</a>";
                $this->addFlash('notice', "cette adresse email est inconnue. Veuillez creer un compte. <br> en cliquant sur " . $lien);  
                }
        }

        return $this->render('reset_password/index.html.twig', [
            
        ]);
    }

    /**
     * @Route("/modification-mot-de-passe/{token}", name="update_password")
     */
    public function update($token, Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $reset_password = $this->entityManager->getRepository(ResetPassword::class)->findOneByToken($token);

        if ( !$reset_password ) {
            return $this->redirectToRoute('reset_password');
        }

        $now = new DateTime();
        if ($now > $reset_password->getCreatedAt()->modify('+ 3 hour')) {
            $this->addFlash('notice', 'votre demande de réinitialisation du mot de passe a expirée. Veuillez La renouveller');
            return $this->redirectToRoute('reset_password');
        }

        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $new_pwd = $form->get('new_password')->getData();

            $password = $encoder->hashPassword($reset_password->getUser(), $new_pwd);
            $reset_password->getUser()->setPassword($password);

            $this->entityManager->flush();

            $this->addFlash('notice', 'Votre mot de passe a bien été mis a jour.');
            return $this->redirectToRoute('app_login');

        }


        return $this->render('reset_password/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
