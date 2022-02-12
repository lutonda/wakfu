<?php

namespace App\Controller;

use App\Entity\Curso;
use App\Form\CursoType;
use App\Repository\CursoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cursos')]
class CursoController extends AbstractController
{
    #[Route('/', name: 'curso_index', methods: ['GET'])]
    public function index(CursoRepository $cursoRepository): Response
    {
        return $this->render('curso/index.html.twig', [
            'cursos' => $cursoRepository->findAll(),
            'title'=>'CURSOS',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/new', name: 'curso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $curso = new Curso();
        $form = $this->createForm(CursoType::class, $curso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($curso);
            $entityManager->flush();

            return $this->redirectToRoute('curso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('curso/new.html.twig', [
            'curso' => $curso,
            'form' => $form,
            'title'=>'CURSOS',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/{id}', name: 'curso_show', methods: ['GET'])]
    public function show(Curso $curso): Response
    {
        return $this->render('curso/show.html.twig', [
            'curso' => $curso,
            'title'=>$curso->getCode().':: '.$curso->getTitulo(),
            'subtitle'=>'CURSOS'
        ]);
    }

    #[Route('/{id}/edit', name: 'curso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Curso $curso, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CursoType::class, $curso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('curso_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('curso/edit.html.twig', [
            'curso' => $curso,
            'form' => $form,
            'title'=>'CURSOS',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/{id}', name: 'curso_delete', methods: ['POST'])]
    public function delete(Request $request, Curso $curso, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$curso->getId(), $request->request->get('_token'))) {
            $entityManager->remove($curso);
            $entityManager->flush();
        }

        return $this->redirectToRoute('curso_index', [], Response::HTTP_SEE_OTHER);
    }
}
