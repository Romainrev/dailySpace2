<?php

namespace App\Controller\dailySpace;


use App\Entity\Commentaire;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class CommentaireController extends Controller

{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/article/{article}")
     */
    public function addCommentaire(Request $request)
    {
        $commentaire = new Commentaire();
        $form = $this->createFormBuilder($commentaire)
            ->add('contenu', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Votre commentaire'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Commenter'
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();
        }
            return $this->render('index/article.html.twig', [
                'form' => $form->createView()

            ]);

    }
}


