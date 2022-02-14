<?php

namespace App\Controller;

use App\Entity\Galeria;
use App\Form\GaleriaType;
use App\Repository\GaleriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/galeria')]
class GaleriaController extends AbstractController
{
    #[Route('/', name: 'galeria_index', methods: ['GET'])]
    public function index(GaleriaRepository $galeriaRepository): Response
    {
        return $this->render('galeria/index.html.twig', [
            'galerias' => $galeriaRepository->findAll(),
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/new', name: 'galeria_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $galeria = new Galeria();
        $form = $this->createForm(GaleriaType::class, $galeria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($galeria);
            $entityManager->flush();

            return $this->redirectToRoute('galeria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('galeria/new.html.twig', [
            'galeria' => $galeria,
            'form' => $form,
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/{id}', name: 'galeria_show', methods: ['GET'])]
    public function show(Galeria $galeria): Response
    {
        return $this->render('galeria/show.html.twig', [
            'galeria' => $galeria,
        ]);
    }

    #[Route('/{id}/edit', name: 'galeria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Galeria $galeria, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GaleriaType::class, $galeria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('galeria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('galeria/edit.html.twig', [
            'galeria' => $galeria,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'galeria_delete', methods: ['POST'])]
    public function delete(Request $request, Galeria $galeria, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$galeria->getId(), $request->request->get('_token'))) {
            $entityManager->remove($galeria);
            $entityManager->flush();
        }

        return $this->redirectToRoute('galeria_index', [], Response::HTTP_SEE_OTHER);
    }
}
