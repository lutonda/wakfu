<?php

namespace App\Controller;

use App\Entity\Lingua;
use App\Form\LinguaType;
use App\Repository\LinguaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lingua')]
class LinguaController extends AbstractController
{
    #[Route('/', name: 'lingua_index', methods: ['GET'])]
    public function index(LinguaRepository $linguaRepository): Response
    {
        return $this->render('lingua/index.html.twig', [
            'linguas' => $linguaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'lingua_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lingua = new Lingua();
        $form = $this->createForm(LinguaType::class, $lingua);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lingua);
            $entityManager->flush();

            return $this->redirectToRoute('lingua_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lingua/new.html.twig', [
            'lingua' => $lingua,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'lingua_show', methods: ['GET'])]
    public function show(Lingua $lingua): Response
    {
        return $this->render('lingua/show.html.twig', [
            'lingua' => $lingua,
        ]);
    }

    #[Route('/{id}/edit', name: 'lingua_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lingua $lingua, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LinguaType::class, $lingua);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('lingua_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lingua/edit.html.twig', [
            'lingua' => $lingua,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'lingua_delete', methods: ['POST'])]
    public function delete(Request $request, Lingua $lingua, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lingua->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lingua);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lingua_index', [], Response::HTTP_SEE_OTHER);
    }
}
