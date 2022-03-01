<?php

namespace App\Controller;

use App\Classes\Cart;
use App\Classes\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(Cart $cart, Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            //$search = $form->getData();
           
           $products = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
        }
        else
            {
                $products = $this->entityManager->getRepository(Product::class)->findAll();
            }

        return $this->render('product/index.html.twig',[
            'products' =>$products,
            'form' =>$form->createView(),
            'cart' => $cart->getFull(),
        ]);
    }


    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show(Cart $cart, $slug): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);

        if(!$product)
        {
            return $this->redirectToRoute('products');
        }


        return $this->render('product/show.html.twig',[
            'product' => $product,
            'products' => $products,
            'cart' => $cart->getFull(),
        ]);
    }



}
