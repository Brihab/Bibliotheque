<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/livre')]
class LivreController extends AbstractController
{
    #[Route('/', name: 'livre_index', methods: ['GET'])]
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),

        ]);
    }

    #[Route('/new', name: 'livre_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/prix",name="Livre_recherche")
     */
    public function exercise2(){
        $repLiv = $this->getDoctrine()->getRepository(Livre::class);
        $livres =$repLiv->findByPrixSup(250);

        return $this->render('livre/index.html.twig',
            ['livres' => $livres]);
    }
    /**
     * @Route("/Prix&Page",name="Prix&Page")
     */
    public function exercisePrixPage(){
        $repLiv = $this->getDoctrine()->getRepository(Livre::class);
        $livres =$repLiv->findByPrixPages(100,250);

        return $this->render('livre/index.html.twig',
            ['livres' => $livres]);
    }

    /**
     * @route("/prix&page1" , name="Prix&Page1")
     *
     */
    public function exercisePrixPage1(){
        $repLiv = $this->getDoctrine()->getRepository(Livre::class);
        $livres =$repLiv->findByPrixPages10(100,250);

        return $this->render('livre/index.html.twig',
            ['livres' => $livres]);
    }

    /**
     * @route("/PrixTrier" , name="PrixTrier")
     *
     */
    public function findByPrixPagesTrie1(){
        $repLiv = $this->getDoctrine()->getRepository(Livre::class);
        $livres =$repLiv->findByPrixPagesTrie1(1,1);

        return $this->render('livre/index.html.twig',
            ['livres' => $livres]);
    }
    /**
     * @route("/PrixPage10" , name="PrixPage10")
     *
     */
    public function findByPrixPages10Trie(){
        $repLiv = $this->getDoctrine()->getRepository(Livre::class);
        $livres =$repLiv->findByPrixPages10Trie(100,1);

        return $this->render('livre/index.html.twig',
            ['livres' => $livres]);
    }
    /**
     * @route("/PrixPageTrier" , name="PrixPageTrier")
     *
     */
    public function findByPrixPagesTrie2(){
        $repLiv = $this->getDoctrine()->getRepository(Livre::class);
        $livres =$repLiv->findByPrixPagesTrie2(100,1);

        return $this->render('livre/index.html.twig',
            ['livres' => $livres]);
    }


    #[Route('/{id}', name: 'livre_show', methods: ['GET'])]
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,


        ]);
    }


    #[Route('/{id}/edit', name: 'livre_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Livre $livre): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form,

        ]);
    }

    #[Route('/{id}', name: 'livre_delete', methods: ['POST'])]
    public function delete(Request $request, Livre $livre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
    }



}
