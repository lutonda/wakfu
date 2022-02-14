<?php

namespace App\Controller;

use App\Entity\Noticia;
use App\Form\NoticiaType;
use App\Repository\NoticiaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/noticia')]
class NoticiaController extends AbstractController
{
    #[Route('/', name: 'noticia_index', methods: ['GET'])]
    public function index(NoticiaRepository $noticiaRepository): Response
    {
        return $this->render('noticia/index.html.twig', [
            'noticias' => $noticiaRepository->findAll(),
            'title'=>'Noticias',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/new', name: 'noticia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $noticium = new Noticia();
        $form = $this->createForm(NoticiaType::class, $noticium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($noticium);
            $entityManager->flush();

            return $this->redirectToRoute('noticia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticia/new.html.twig', [
            'noticium' => $noticium,
            'form' => $form,
            'title'=>'Notícias',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }
    
    #[Route('/lite', name: 'noticia_index_lite', methods: ['GET', 'POST'])]
    public function lite(NoticiaRepository $noticiaRepository): Response
    {
        return $this->render('noticia/lite.html.twig', [
            'noticias' => $noticiaRepository->findAll()
        ]);
    }

    #[Route('/{id}', name: 'noticia_show', methods: ['GET'])]
    public function show(Noticia $noticium): Response
    {
        return $this->render('noticia/show.html.twig', [
            'noticium' => $noticium,
        ]);
    }

    #[Route('/{id}/edit', name: 'noticia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Noticia $noticium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NoticiaType::class, $noticium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('noticia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticia/edit.html.twig', [
            'noticium' => $noticium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'noticia_delete', methods: ['POST'])]
    public function delete(Request $request, Noticia $noticium, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noticium->getId(), $request->request->get('_token'))) {
            $entityManager->remove($noticium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('noticia_index', [], Response::HTTP_SEE_OTHER);
    }
}
