<?php

namespace App\Controller;

use App\Classes\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutUsController extends AbstractController
{
    /**
     * @Route("/qui-sommes-nous", name="about_us")
     */
    public function index(Cart $cart): Response
    {
        return $this->render('about_us/index.html.twig', [
            'cart' => $cart->getFull(),
        ]);
    }
}
