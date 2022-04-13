<?php

namespace App\Controller;

use App\Entity\Sobre;
use App\Form\SobreType;
use App\Repository\SobreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/sobres')]
class SobreController extends AbstractController
{
    #[Route('/', name: 'sobre_index', methods: ['GET'])]
    public function index(SobreRepository $sobreRepository): Response
    {
        return $this->render('sobre/index.html.twig', [
            'sobres' => $sobreRepository->findAll(),
            'title'=>'Contactos',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'sobre_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sobre = new Sobre();
        $form = $this->createForm(SobreType::class, $sobre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sobre);
            $entityManager->flush();

            return $this->redirectToRoute('sobre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sobre/new.html.twig', [
            'sobre' => $sobre,
            'form' => $form,
            'title'=>'Contactos',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',

        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'sobre_show', methods: ['GET'])]
    public function show(Sobre $sobre): Response
    {
        return $this->render('sobre/show.html.twig', [
            'sobre' => $sobre,
            'title'=>'Contactos',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',

        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'sobre_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sobre $sobre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SobreType::class, $sobre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('sobre', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sobre/edit.html.twig', [
            'sobre' => $sobre,
            'form' => $form,
            'title'=>'Contactos',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',

        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'sobre_delete', methods: ['POST'])]
    public function delete(Request $request, Sobre $sobre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sobre->getId(), $request->request->get('_token'))) {
          //  $entityManager->remove($sobre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sobre_index', [], Response::HTTP_SEE_OTHER);
    }
}
