<?php
/**
 * Created by PhpStorm.
 * User: Kati
 * Date: 07/01/2019
 * Time: 17:42
 */

namespace ChristmasShopBundle\Controller;


use ChristmasShopBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categories")
 * Class CategoriesController
 * @package ChristmasShopBundle\Controller
 */
class CategoriesController extends Controller
{
    /**
     * @Route("/trees", name="christmas_tree")
     */
    public function christmasTreeAction()
    {
        $snowTrees=$this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('categories/christmasTrees.twig',['snowTrees' => $snowTrees]);
    }

    /**
     * @Route("/toys", name="tree_toys")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function treeToysAction()
    {
        $snowTrees=$this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('categories/treeToys.twig',['snowTrees' => $snowTrees]);
    }

    /**
     * @Route("/houseDecorations", name="house_decorations")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function houseDecorationsAction()
    {
        $snowTrees=$this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('categories/houseDecorations.html.twig',['snowTrees' => $snowTrees]);
    }

    /**
     * @Route("/costumes", name="costumes")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function costumesAction()
    {
        $snowTrees=$this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('categories/houseDecorations.html.twig',['snowTrees' => $snowTrees]);
    }
}