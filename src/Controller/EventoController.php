<?php

namespace App\Controller;

use App\Entity\Evento;
use App\Form\EventoType;
use App\Repository\EventoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/eventos')]
class EventoController extends AbstractController
{
    #[Route('/', name: 'evento_index', methods: ['GET'])]
    public function index(EventoRepository $eventoRepository): Response
    {
        return $this->render('evento/index.html.twig', [
            'eventos' => $eventoRepository->findAll(),
            'title'=>'CURSOS',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/new', name: 'evento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evento = new Evento();
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($evento);
            $entityManager->flush();

            return $this->redirectToRoute('evento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evento/new.html.twig', [
            'evento' => $evento,
            'form' => $form,
            'title'=>'CURSOS',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/{id}', name: 'evento_show', methods: ['GET'])]
    public function show(Evento $evento): Response
    {
        return $this->render('evento/show.html.twig', [
            'evento' => $evento,
        ]);
    }

    #[Route('/{id}/edit', name: 'evento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evento $evento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventoType::class, $evento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('evento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evento/edit.html.twig', [
            'evento' => $evento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'evento_delete', methods: ['POST'])]
    public function delete(Request $request, Evento $evento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evento->getId(), $request->request->get('_token'))) {
            $entityManager->remove($evento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('evento_index', [], Response::HTTP_SEE_OTHER);
    }
}
