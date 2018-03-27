<?php


namespace App\Controller\dailySpace;


use App\Entity\Evenement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MailController extends Controller
{
    /**
     *
     * @param \Swift_Mailer $mailer
     * @Route("/email",name="index_email")
     */
    public function mail( \Swift_Mailer $mailer){
        $evenement=$this->getDoctrine()->getRepository(Evenement::class)->findAll();
        $message = (new \Swift_Message(''))
            ->setFrom('me@example.com')
            ->setTo('alallah@gmail.com')





            ->setBody(
                $this->renderView('Email/newsletter.html.twig',['evenement'=>$evenement]
                ));


        $mailer->send($message);
        return $this->redirectToRoute('index_accueil');
    }

}