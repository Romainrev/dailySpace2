<?php

namespace App\Controller\dailySpace;

use App\Controller\Helper;
use App\Entity\Article;
use App\Entity\Categorie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class ArticleController extends Controller
{
    use Helper;

    /**
     * @param Request $request
     * @return mixed
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/creer-un-article",name="add_article")
     */
    public function addarticle(Request $request) {
        # Récupération des catégories
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        # Création d'un nouvel article
        $article = new Article();
        $form = $this->createFormBuilder($article)
            # Champ TITREARTICLE
            ->add('titre', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control',
                    'placeholder'   =>  'Titre de l\'Article...'
                ]
            ])
            # Champ Categorie
            ->add('categorie', EntityType::class, [
                'class'  => Categorie::class,
                'choice_label'=>'libelle',
                'required'=>true,
                'expanded'=>false,
                'multiple'=>false,
                'attr'          => [
                    'class'         =>  'form-control',
                ]
            ])
            ->add('contenu', TextareaType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control',
                    'placeholder'   =>  'Contenu de l\'Article...'
                ]
            ])
            ->add('image', FileType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'dropify',
                ]
            ])


            ->add('spotlight', CheckboxType::class, [
                'required'      => false,
                'label'         => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Publier',
                'attr'      => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) :
            $article=$form->getData();
            $image=$article->getimage();
            $fileName=$this->slugify($article->getTitre()).$image->guessExtension();
            $image->move($this->getParameter('articles_assets-dir'),$fileName);
            $article->setimage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

        endif;
        return $this->render('Article/ajouterarticle.html.twig', [
            'form' => $form->createView()
        ]);
    }

}