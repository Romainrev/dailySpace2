<?php

namespace App\Controller\dailySpace;


use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/accueil")
     */
public function index(){
    return $this->render('index/index.html.twig');

}
    /**
     * @Route("/categorie/{libelle}",methods={"GET"})
     */
public function categorie($libelle='test'){
    return $this->render('index/categorie.html.twig');
}


    /**
     * @Route("/article/{article}",methods={"GET"})
     */
    public function article($article='plop'){
        return $this->render('index/article.html.twig');

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/monCompte",name="compte")
     */
    public function monCompte(){
        return $this->render('Compte/compte.html.twig');
    }
    public function sidebar(){
        $evenements=$this->getDoctrine()->getRepository( Evenement::class)->findAll();
        return $this->render('components/sidebar.html.twig',[
            'evenements'=>$evenements

        ]);
    }
}

