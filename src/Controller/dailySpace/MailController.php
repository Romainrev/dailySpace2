<?php
namespace App\Controller\dailySpace;
use App\Entity\Evenement;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
class MailController extends Controller
{
    /**
     * @param \Swift_Mailer $mailer
     * @Route("/email",name="index_email")
     */
    public function Newsletter(\Swift_Mailer $mailer){
        //$email=$this->getDoctrine()->getRepository(Users::class)->Users();
        $evenement=$this->getDoctrine()->getRepository(Evenement::class)->findLastfive();
        $message = (new \Swift_Message('Rappel évenement'))
            ->setFrom('contact@dailyspace.com')
            ->setTo("test@gmail.com")
            ->setCc('test2@gmail.com')
            ->setBody($this->renderView('Email/newsletter.html.twig',['evenement'=>$evenement]));
        $mailer->send($message);
        return $this->redirectToRoute('index_accueil');
    }
}