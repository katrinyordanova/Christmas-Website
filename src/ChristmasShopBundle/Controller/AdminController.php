<?php

namespace ChristmasShopBundle\Controller;

use ChristmasShopBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin")
 * Class AdminController
 * @package ChristmasShopBundle\Controller
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin_allUsers")
     */
    public function viewUsersAction()
    {
        $users=$this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/viewUsers.html.twig',['users'=>$users]);
    }

    /**
     * @Route("/user/{id}", name="admin_user")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewSingleUser($id)
    {
        $singleUser=$this->getDoctrine()->getRepository(User::class)->find($id);

        if (null === $singleUser){
           return $this->redirectToRoute('admin_allUsers');
        }

        return $this->render('admin/singleUser.html.twig',['user'=>$singleUser]);
    }
    /**
     * @Route("/delete/{id}", name="admin_delete")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeUserAction($id)
    {
        $user=$this->getDoctrine()->getRepository(User::class)->find($id);

        if (null===$user) {
            return $this->redirectToRoute('admin_allUsers');
        }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();

        return $this->redirectToRoute('admin_allUsers');
    }
}
