<?php

namespace ChristmasShopBundle\Controller;

use ChristmasShopBundle\Entity\Role;
use ChristmasShopBundle\Entity\User;
use ChristmasShopBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $user=new User();
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()){
            $userEmail=$form->getData()->getEmail();

            $checkUser=$this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['email'=> $userEmail]);

            if (null !== $checkUser){
                $this->addFlash("error", "A user with email".$userEmail.'already exists.\n Please, enter another email.');
               return $this->render('user/register.html.twig');
            }

            $password=$this->get('security.password_encoder')
                ->encodePassword($user,$user->getPassword());

            $user->setPassword($password);

            $getRole=$this->getDoctrine()
                ->getRepository(Role::class)
                ->findOneBy(['name'=>'ROLE_USER']);

            if (null!==$getRole)
            {
                $user->addRole($getRole);
            }
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute("security_login");
        }
        return $this->render('user/register.html.twig', ['form'=>$form->createView()]);
    }

    /**
     * @Route("/profile", name="user_profile")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function profileViewAction()
    {
        $currentUserId=$this->getUser()->getId();
        $profile=$this->getDoctrine()
            ->getRepository(User::class)
            ->find($currentUserId);

        return $this->render('user/profile.html.twig',['user'=>$profile]);
    }

    /**
     * @Route("/edit/{id}", name="user_edit")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editProfileAction(Request $request,$id)
    {
        $user=$this->getDoctrine()->getRepository(User::class)->find($id);

        if (null===$user){
            return $this->redirectToRoute('homepage');
        }

        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);

//        /** @var User $currentUser */
//        $currentUser=$this->getUser();

//        if (!$currentUser->isAdmin() and !$currentUser->isAuthor($user)){
//            return $this->redirectToRoute("blog_index");
//        }
        if ($form->isSubmitted() and $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->merge($user);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }
        return $this->render('user/editProfile.html.twig',
            ['form'=>$form->createView(),'user'=>$user]);
    }

    /**
     * @Route("/delete/{id}", name="user_delete" ,requirements={"name": ".+"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteProfileAction(Request $request,$id)
    {
        $user=$this->getDoctrine()->getRepository(User::class)->find($id);

        if (null === $user){
            return $this->render('user/profile.html.twig');
        }

        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);

        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();

        return $this->render('user/delete.html.twig',['form'=>$form->createView(),'user'=>$user]);
    }

    /**
     * @Route("favorite/", name="user_favorite")
     * @param $id
     */
    public function favoriteProductAction($id)
    {

    }
}
