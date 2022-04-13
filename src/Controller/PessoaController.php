<?php

namespace App\Controller;

use App\Entity\Pessoa;
use App\Form\PessoaType;
use App\Repository\PessoaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/pessoa')]
class PessoaController extends AbstractController
{
    #[Route('/', name: 'pessoa_index', methods: ['GET'])]
    public function index(PessoaRepository $pessoaRepository): Response
    {
        return $this->render('pessoa/index.html.twig', [
            'pessoas' => $pessoaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'pessoa_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pessoa = new Pessoa();
        $form = $this->createForm(PessoaType::class, $pessoa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pessoa);
            $entityManager->flush();

            return $this->redirectToRoute('pessoa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pessoa/new.html.twig', [
            'pessoa' => $pessoa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pessoa_show', methods: ['GET'])]
    public function show(Pessoa $pessoa): Response
    {
        return $this->render('pessoa/show.html.twig', [
            'pessoa' => $pessoa,
        ]);
    }

    #[Route('/{id}/edit', name: 'pessoa_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pessoa $pessoa, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PessoaType::class, $pessoa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('pessoa_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pessoa/edit.html.twig', [
            'pessoa' => $pessoa,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'pessoa_delete', methods: ['POST'])]
    public function delete(Request $request, Pessoa $pessoa, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pessoa->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pessoa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pessoa_index', [], Response::HTTP_SEE_OTHER);
    }
}
