<?php

namespace App\Controller\Security;

use App\Form\UsersType;
use App\Entity\Roles;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{

    /**
     * Connexion d'un utilisateur
     * @Route("/connexion", name="security_connexion")
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function connexion(Request $request, AuthenticationUtils $authenticationUtils)
    {
        # Récupération du message d'erreur s'il y en a un.
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastMail = $authenticationUtils->getLastUsername();
        
        return $this->render('Connexion/connexion.html.twig', array(
            'last_mail'    => $lastMail,
            'error'         => $error,
        ));
    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/inscription",name="inscription",methods={"GET","POST"})
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $users = new Users();
        $users->setRoles('ROLE_USERS');

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