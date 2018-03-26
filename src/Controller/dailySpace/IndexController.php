<?php
namespace App\Controller\dailySpace;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
class IndexController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/accueil",name="index_accueil")
     */
    public function index()
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('index/index.html.twig', ['articles' => $article]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/systemeSolaire",name="index_systemeSolaire")
     */
    public function systemeSolaire()
    {
        return $this->render('index/systemeSolaire.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/normandie",name="index_normandie")
     */
    public function normandie()
    {
        return $this->render('index/normandie.html.twig');
    }

    /**
     * @Route("/categorie",name="index_categorie",methods={"GET"})
     */
    public function categorie($libelle = 'test')
    {
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $spotlight = $this->getDoctrine()->getRepository(Article::class)->spotlight();
        return $this->render('index/categorie.html.twig', ['categories' => $categories, 'spotlight' => $spotlight]);
    }

    /**
     * @Route("/cateogrie/{libelle}",name="index_selectCategorie",methods={"GET"})
     */
    public function selectCategorie($libelle = 'test')
    {
        $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(['libelle' => $libelle]);
        $article = $categorie->getArticles();
        return $this->render('index/selectCategorie.html.twig', ['articles' => $article]);
    }

    /**
     * @param string $article
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("{libelle}/{slugarticle}_{id}.html",name="index_article",requirements={"id"="\d+"},methods={"GET"})
     */
    public function article(Article $article, Request $request)
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
            'form' => $form->createView(), 'article' => $article
        ]);
        // return $this->render('index/article.html.twig',['article'=>$article]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/monCompte",name="compte")
     */
    public function monCompte()
    {
        return $this->render('Compte/compte.html.twig');
    }

    public function sidebar()
    {
        $evenements = $this->getDoctrine()->getRepository(Evenement::class)->findLastfive();
        return $this->render('components/sidebar.html.twig', ['evenements' => $evenements]);
    }
}

