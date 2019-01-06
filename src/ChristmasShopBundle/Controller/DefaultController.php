<?php

namespace ChristmasShopBundle\Controller;

use ChristmasShopBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function viewProductsAction()
    {
        $products=$this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('default/index.html.twig', ['products'=>$products]);
    }
}
