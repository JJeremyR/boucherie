<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/compte/modification-password", name="account_password")
     */
    public function index(Cart $cart, Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $notif =null;


        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $old_pwd = $form->get('old_password')->getData();
            if($encoder->isPasswordValid($user, $old_pwd)){
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($user, $new_pwd);

                $user->setPassword($password);
                $this->entityManager->flush();
                $notif = "Mot De Passe Modifié";
            }
            else{
                $notif = "Mot De Passe érronné";
                }
            

        }

        return $this->render('account/password.html.twig',[
            'form' => $form->createView(),
            'cart' => $cart->getFull(),
            'notif' => $notif
        ]);
    }
}
