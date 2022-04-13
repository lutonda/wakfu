<?php

namespace App\Controller;

use App\Entity\Candidatura;
use App\Entity\VagaEmprego;
use App\Form\CandidaturaType;
use App\Repository\CandidaturaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidatura')]
class CandidaturaController extends AbstractController
{
    #[Route('/', name: 'candidatura_index', methods: ['GET'])]
    public function index(CandidaturaRepository $candidaturaRepository): Response
    {
        return $this->render('candidatura/index.html.twig', [
            'candidaturas' => $candidaturaRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'candidatura_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VagaEmprego $vagaEmprego, EntityManagerInterface $entityManager): Response
    {
        $candidatura = new Candidatura();
        $form = $this->createForm(CandidaturaType::class, $candidatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($candidatura);
            $entityManager->flush();

            return $this->redirectToRoute('candidatura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidatura/new.html.twig', [
            'candidatura' => $candidatura,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'candidatura_show', methods: ['GET'])]
    public function show(Candidatura $candidatura): Response
    {
        return $this->render('candidatura/show.html.twig', [
            'candidatura' => $candidatura,
        ]);
    }

    #[Route('/{id}/edit', name: 'candidatura_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidatura $candidatura, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CandidaturaType::class, $candidatura);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('candidatura_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidatura/edit.html.twig', [
            'candidatura' => $candidatura,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'candidatura_delete', methods: ['POST'])]
    public function delete(Request $request, Candidatura $candidatura, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidatura->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidatura);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidatura_index', [], Response::HTTP_SEE_OTHER);
    }
}
