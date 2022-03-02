<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Classes\Mail;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderSuccessController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/merci/{stripeSessionId}", name="order_success")
     */
    public function index(Cart $cart, $stripeSessionId): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($stripeSessionId);

        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }

        if ($order->getState() == 0) {
            $cart->remove();
            $order->setState(1);
            $this->entityManager->flush();
        
            $mail = new Mail();

            $client = $order->getUser()->getFullName();
            $commande = $order->getReference();
            $message = " Votre commande N° " . $commande . " a bien été validée, <br> elle est actuellement en cours de preparation. <br> vous recevrez bientot un mail vous confirmant son expedition <br> ainsi que son numero de suivi <br>" ;
            $envoi = $order->getUser()->getEmail();
            $sujet = "Votre Commande Boucherie Paux est bien validée";
            $contenu = "Bonjour " . $client . ", <br> Merci pour votre commande. <br>" . $message;

            $mail->send($envoi, $client, $sujet, $contenu);
        
        }

        return $this->render('order_success/index.html.twig',[
            'order' => $order,
            'cart' => $cart->getfull(),
        ]);
    }
}
