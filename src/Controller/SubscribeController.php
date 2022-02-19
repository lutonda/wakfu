<?php

namespace App\Controller;

use App\Entity\Subscribe;
use App\Form\SubscribeType;
use App\Repository\SubscribeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/subscribe')]
class SubscribeController extends AbstractController
{
    #[Route('/', name: 'subscribe_index', methods: ['GET'])]
    public function index(SubscribeRepository $subscribeRepository): Response
    {
        return $this->render('subscribe/index.html.twig', [
            'subscribes' => $subscribeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'subscribe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subscribe = new Subscribe();
        $form = $this->createForm(SubscribeType::class, $subscribe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($subscribe);
            $entityManager->flush();

            return $this->redirectToRoute('subscribe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('subscribe/new.html.twig', [
            'subscribe' => $subscribe,
            'form' => $form,
            'title'=>'',
            'subtitle'=>''
        ]);
    }
    #[Route('/new/Lite', name: 'subscribe_new_lite', methods: ['GET', 'POST'])]
    public function lite(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subscribe = new Subscribe();
        $form = $this->createForm(SubscribeType::class, $subscribe);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            var_dump('entered');
            $entityManager->persist($subscribe);
            $entityManager->flush();

            return $this->redirect($request->headers->get('referer').'?success=subscribe');
        }
        return $this->redirect($request->headers->get('referer').'?success=subscribe');
    }

    #[Route('/{id}', name: 'subscribe_show', methods: ['GET'])]
    public function show(Subscribe $subscribe): Response
    {
        return $this->render('subscribe/show.html.twig', [
            'subscribe' => $subscribe,
        ]);
    }

    #[Route('/{id}/edit', name: 'subscribe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Subscribe $subscribe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SubscribeType::class, $subscribe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('subscribe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('subscribe/edit.html.twig', [
            'subscribe' => $subscribe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'subscribe_delete', methods: ['POST'])]
    public function delete(Request $request, Subscribe $subscribe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subscribe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($subscribe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subscribe_index', [], Response::HTTP_SEE_OTHER);
    }
}
