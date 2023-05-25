<?php

namespace App\Controller;


use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Entity\Projet;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UtilisateurType;
use App\Form\ProjetType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



class IndexController extends AbstractController
{

    ///affiche tout les utilisateurs
    #[Route('/', name: 'home.index')]
    public function home(ArticleRepository $repository): Response
    {
        //return new Response('<h1>Ma première page Symfony</h1>');
        //return $this->render('article/index.html.twig');
        /*** */
        //$articles = ['Article 1', 'Article 2', 'Article 3'];
        //return $this->render('articles/index.html.twig', ['articles' => $articles]);
        /***** */
        //récupérer tous les articles de la table article de la BD
        // et les mettre dans le tableau $articles
        #$articles= $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('index.html.twig',['utilisateurs'=>$repository-> findAll()]);
    }

#[Route('/ut', name: 'utilisateur.new', methods:['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager) {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class,$utilisateur);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $utilisateur = $form->getData();
            $entityManager->persist($utilisateur);

            $entityManager->flush();
            return $this->redirectToRoute('home.new');
        }

        return $this->render('utilisateur.html.twig',['form' => $form->createView()]);
    }

    #[Route('/', name: 'projet.new', methods:['GET','POST'])]
    public function Projet(Request $request, EntityManagerInterface $entityManager) {
        $projet = new projet();
        $form = $this->createForm(ProjetType::class,$projet);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $projet = $form->getData();
            $entityManager->persist($projet);
            
            $entityManager->flush();
            return $this->redirectToRoute('projet.new');
        }

        return $this->render('projet.html.twig',['form' => $form->createView()]);
    }
}
?>