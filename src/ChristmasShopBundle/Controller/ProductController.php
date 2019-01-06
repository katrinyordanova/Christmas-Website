<?php

namespace ChristmasShopBundle\Controller;

use ChristmasShopBundle\Entity\Product;
use ChristmasShopBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("product")
 * Class ProductController
 * @package ChristmasShopBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * @Route("/", name="product_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createProductAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            /** @var UploadedFile $image */
            $image=$form->getData()->getImage();
            $imageName =md5(uniqid()).'.'. $image->getClientOriginalExtension();

            try {
                $image->move(
                    $this->getParameter('images_directory'),
                    $imageName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $product->setImage($imageName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success','Successfully added a new product!');
            return $this->redirectToRoute('homepage');
        }
        return $this->render('product/addProduct.html.twig',
            ['form' => $form->createView(), 'product' => $product]);
    }

    /**
     * @Route("/{id}", name="product_view")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewProductAction($id)
    {
        $product=$this->getDoctrine()->getRepository(Product::class)->find($id);

        return $this->render('product/viewProduct.html.twig',['product'=>$product]);
    }

    /**
     * @Route("/edit/{id}", name="product_edit")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editProductAction(Request $request, $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (null === $product) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            /** @var UploadedFile $image */
            $image=$form->getData()->getImage();
            $imageName =md5(uniqid()).'.'. $image->getClientOriginalExtension();

            try {
                $image->move(
                    $this->getParameter('images_directory'),
                    $imageName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $product->setImage($imageName);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->merge($product);
            $entityManager->flush();

            //add a flash message when this is successful
            return $this->redirectToRoute('homepage');
            //return $this->render('product/viewProduct.html.twig');
        }

        return $this->render('product/editProduct.html.twig', ['form' => $form->createView(), 'product' => $product]);
    }

    /**
     * @Route("/delete/{id}", name="product_delete")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteProductAction(Request $request, $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);

        if (null === $product) {
            return $this->redirectToRoute('homepage');
        }

//        $form = $this->createForm(ProductType::class, $product);
//        $form->handleRequest($request);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();

            // add a flash message when this is successful
            return $this->redirectToRoute('homepage');
        
        //return $this->render('product/deleteProduct.html.twig', ['form' => $form->createView(), 'product' => $product]);
    }

    /**
     * @Route("/order", name="product_order")
     */
    public function orderProductAction()
    {

    }
}
