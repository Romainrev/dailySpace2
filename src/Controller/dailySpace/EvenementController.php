<?php


namespace App\Controller\dailySpace;

use App\Entity\Evenement;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class EvenementController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/creer-un-evenement",name="add_event")
     */

    public function addEvenement(Request $request){
        $evenement= new Evenement();
        $form=$this->createFormBuilder($evenement)
            ->add('titre',TextType::class,[
                'required'=> true,
                'attr' =>[
                    'placeholder'=>'Titre de l\'évenement'
                ]
            ])
            ->add('date',DateTimeType::class,[
                'required'=>true

            ])
            ->add('sumbit',SubmitType::class,[
                'label'=>'Publier'
            ])
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $evenement=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();
        }
        return $this->render('Evenement/ajouterevenement.html.twig',[
            'form'=>$form->createView()
        ]);

    }

}