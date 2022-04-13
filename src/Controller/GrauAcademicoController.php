<?php

namespace App\Controller;

use App\Entity\GrauAcademico;
use App\Form\GrauAcademicoType;
use App\Repository\GrauAcademicoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/grau/academico')]
class GrauAcademicoController extends AbstractController
{
    #[Route('/', name: 'grau_academico_index', methods: ['GET'])]
    public function index(GrauAcademicoRepository $grauAcademicoRepository): Response
    {
        return $this->render('grau_academico/index.html.twig', [
            'grau_academicos' => $grauAcademicoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'grau_academico_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $grauAcademico = new GrauAcademico();
        $form = $this->createForm(GrauAcademicoType::class, $grauAcademico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($grauAcademico);
            $entityManager->flush();

            return $this->redirectToRoute('grau_academico_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('grau_academico/new.html.twig', [
            'grau_academico' => $grauAcademico,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'grau_academico_show', methods: ['GET'])]
    public function show(GrauAcademico $grauAcademico): Response
    {
        return $this->render('grau_academico/show.html.twig', [
            'grau_academico' => $grauAcademico,
        ]);
    }

    #[Route('/{id}/edit', name: 'grau_academico_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GrauAcademico $grauAcademico, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GrauAcademicoType::class, $grauAcademico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('grau_academico_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('grau_academico/edit.html.twig', [
            'grau_academico' => $grauAcademico,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'grau_academico_delete', methods: ['POST'])]
    public function delete(Request $request, GrauAcademico $grauAcademico, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$grauAcademico->getId(), $request->request->get('_token'))) {
            $entityManager->remove($grauAcademico);
            $entityManager->flush();
        }

        return $this->redirectToRoute('grau_academico_index', [], Response::HTTP_SEE_OTHER);
    }
}
