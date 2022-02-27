<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Entity\Order;
use App\Entity\OrderDetails;
use App\Form\OrderType;
use DateTime; //
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande", name="order")
     */
    public function index(Cart $cart, Request $request): Response
    {
        if(!$this->getUser()->getAdresses()->getValues())
        {
            return $this->redirectToRoute('add_adress');
        }

        $form = $this->createForm(OrderType::class, null, [
            'user'=>$this->getUser()
        ]);

        return $this->render('order/index.html.twig',[
            'form' => $form->createView(),
            'cart' => $cart->getFull()
        ]);
    }
        /**
     * @Route("/commande/recapitulatif", name="order-recap", methods={"POST"})
     */
    public function add(Cart $cart, Request $request): Response
    {
        $form = $this->createForm(OrderType::class, null, [
            'user'=>$this->getUser()
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $date = New DateTime();
            $carrier = $form->get('carriers')->getData();
            $delivery =$form->get('adresses')->getData();
            $delivery_content = $delivery->getFirstName().' '.$delivery->getLastName();

            if($delivery->getPhone() && !$delivery->getCell()){
                $delivery_content .= '<br>'.$delivery->getPhone();
            }
            else if(!$delivery->getPhone() && $delivery->getCell()){
                $delivery_content .= '<br>'.$delivery->getCell();
            }
            else if($delivery->getPhone() && $delivery->getCell()){
                $delivery_content .= '<br>'.$delivery->getPhone().' - '.$delivery->getCell();
            }


            if($delivery->getCompany()){
                $delivery_content .= '<br>'.$delivery->getCompany();
            }

            $delivery_content .= '<br>'.$delivery->getAdress();
            $delivery_content .= '<br>'.$delivery->getPostal().' '.$delivery->getCity();

            /* enregistrer ma commande Order() */
            $order= New Order();
            $reference = $date->format('dmY').'-'.uniqid();
            $order->setReference($reference);
            $order->setUser($this->getUser());
            $order->setCreatedAt($date);
            $order->setCarrierName($carrier->getName());
            $order->setCarrierPrice($carrier->getPrice());
            $order->setDelivery($delivery_content);
            $order->setState(0);

            $this->entityManager->persist($order);

            foreach($cart->getFull() as $product){
                $orderDetails = New OrderDetails();
                $orderDetails->setMyOrder($order);
                $orderDetails->setProduct($product['product']->getName());
                $orderDetails->setQuantity($product['quantity']);
                $orderDetails->setPrice($product['product']->getPrice());
                $orderDetails->setTotal($product['product']->getPrice() * $product['quantity']);
                $this->entityManager->persist($orderDetails);
            }

            $this->entityManager->flush();

            return $this->render('order/add.html.twig',[
                'cart' => $cart->getFull(),
                'carrier' => $carrier,
                'delivery' => $delivery_content,
                'reference' => $order->getReference(),
            ]);
        }

        return $this->redirectToRoute('cart');

    }
}
