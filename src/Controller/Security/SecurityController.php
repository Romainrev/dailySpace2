<?php

namespace App\Controller\Security;

use App\Form\UsersType;
use App\Entity\Roles;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/inscription",methods={"GET","POST"})
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $users = new Users();
        $roles= $this->getDoctrine()->getRepository(Roles::class)->find(2);
        $users->setRoles($roles);

        $form=$this->createForm(UsersType::class,$users);

        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $password=$passwordEncoder->encodePassword($users,$users->getPassword());
            $users->setPassword($password);
            $users=$form->getData();
            $em= $this->getDoctrine()->getManager();
            $em->persist($users);
            $em->flush();
        }
        return $this->render('Inscription/inscription.html.twig',[
            'form'=>$form->createView()
        ]);

    }
}