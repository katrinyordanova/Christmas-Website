<?php

namespace ChristmasShopBundle\Controller;

use ChristmasShopBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use ChristmasShopBundle\Entity\User;

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

    /**
     * @Route("/product/{id}", name="product_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewProductAction($id)
    {
        $product=$this->getDoctrine()->getRepository(Product::class)->find($id);
        //var_dump($product);exit;
        return $this->render('product/viewProduct.html.twig',['product'=>$product]);
    }

    /**
     *
     * @Route("/order", name="product_order")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function orderProduct($id)
    {
        return $this->render('order/orderProduct.html.twig');
    }
}
