<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Entity\Adress;
use App\Form\AdressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAdressController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/compte/adresses", name="account_adress")
     */
    public function index(Cart $cart): Response
    {
        return $this->render('account/adress.html.twig', [
            'cart' => $cart->getFull(),
        ]);
    }
        /**
     * @Route("/compte/ajouter-adresse", name="add_adress")
     */
    public function add(Cart $cart, Request $request): Response
    {
        $adresse = New Adress();
        $form = $this->createForm(AdressType::class, $adresse);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $adresse->setUser($this->getUser());
            $this->entityManager->persist($adresse);
            $this->entityManager->flush();

            if($cart->get()){
                return $this->redirectToRoute('order');    
            }
            else{
                return $this->redirectToRoute('account_adress');
            }

        }

        return $this->render('account/form-adress.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull(),
        ]);
    }
            /**
     * @Route("/compte/modifier-adresse/{id}", name="edit_adress")
     */
    public function edit(Cart $cart, Request $request, $id): Response
    {
        $adresse = $this->entityManager->getRepository(Adress::class)->findOneById($id);
        if(!$adresse || $adresse->getUser() != $this->getUser()){
            return $this->redirectToRoute('account_adress');
        }

        $form = $this->createForm(AdressType::class, $adresse);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->flush();
            return $this->redirectToRoute('account_adress');
        }

        return $this->render('account/form-adress.html.twig', [
            'form' => $form->createView(),
            'cart' => $cart->getFull(),
        ]);
    }

                /**
     * @Route("/compte/supprimer-adresse/{id}", name="delete_adress")
     */
    public function delete($id): Response
    {
        $adresse = $this->entityManager->getRepository(Adress::class)->findOneById($id);
        if($adresse && $adresse->getUser() == $this->getUser()){
            $this->entityManager->remove($adresse);
            $this->entityManager->flush();
        }

            return $this->redirectToRoute('account_adress');
    }

}
