<?php

namespace App\Controller;

use App\Entity\Instituicional;
use App\Form\InstituicionalType;
use App\Repository\InstituicionalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/instituicionais')]
class InstituicionaisController extends AbstractController
{
    #[Route('/', name: 'instituicionais_index', methods: ['GET'])]
    public function index(InstituicionalRepository $instituicionalRepository): Response
    {
        return $this->render('instituicionais/index.html.twig', [
            'instituicionals' => $instituicionalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'instituicionais_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $instituicional = new Instituicional();
        $form = $this->createForm(InstituicionalType::class, $instituicional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($instituicional);
            $entityManager->flush();

            return $this->redirectToRoute('instituicionais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instituicionais/new.html.twig', [
            'instituicional' => $instituicional,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'instituicionais_show', methods: ['GET'])]
    public function show(Instituicional $instituicional): Response
    {
        return $this->render('instituicionais/show.html.twig', [
            'instituicional' => $instituicional,
        ]);
    }

    #[Route('/{id}/edit', name: 'instituicionais_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Instituicional $instituicional, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InstituicionalType::class, $instituicional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('instituicionais_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instituicionais/edit.html.twig', [
            'instituicional' => $instituicional,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'instituicionais_delete', methods: ['POST'])]
    public function delete(Request $request, Instituicional $instituicional, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instituicional->getId(), $request->request->get('_token'))) {
            $entityManager->remove($instituicional);
            $entityManager->flush();
        }

        return $this->redirectToRoute('instituicionais_index', [], Response::HTTP_SEE_OTHER);
    }
}
