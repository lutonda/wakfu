<?php

namespace App\Controller;

use App\Entity\VagaEmprego;
use App\Form\VagaEmpregoType;
use App\Repository\VagaEmpregoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/vagas_emprego')]
class VagaEmpregoController extends AbstractController
{
    #[Route('/', name: 'vaga_emprego_index', methods: ['GET'])]
    public function index(VagaEmpregoRepository $vagaEmpregoRepository): Response
    {
        return $this->render('vaga_emprego/index.html.twig', [
            'vaga_empregos' => $vagaEmpregoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'vaga_emprego_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vagaEmprego = new VagaEmprego();
        $form = $this->createForm(VagaEmpregoType::class, $vagaEmprego);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vagaEmprego);
            $entityManager->flush();

            return $this->redirectToRoute('vaga_emprego_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vaga_emprego/new.html.twig', [
            'vaga_emprego' => $vagaEmprego,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'vaga_emprego_show', methods: ['GET'])]
    public function show(VagaEmprego $vagaEmprego): Response
    {
        return $this->render('vaga_emprego/show.html.twig', [
            'vaga_emprego' => $vagaEmprego,
        ]);
    }

    #[Route('/{id}/edit', name: 'vaga_emprego_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, VagaEmprego $vagaEmprego, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VagaEmpregoType::class, $vagaEmprego);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('vaga_emprego_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vaga_emprego/edit.html.twig', [
            'vaga_emprego' => $vagaEmprego,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'vaga_emprego_delete', methods: ['POST'])]
    public function delete(Request $request, VagaEmprego $vagaEmprego, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vagaEmprego->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vagaEmprego);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vaga_emprego_index', [], Response::HTTP_SEE_OTHER);
    }
}
