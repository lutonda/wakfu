<?php

namespace App\Controller;

use App\Entity\Contato;
use App\Form\ContatoType;
use App\Repository\ContatoRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\ContatoRepository as RepositoryContatoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contato')]
class ContatoController extends AbstractController
{
    #[Route('/', name: 'contato_index', methods: ['GET'])]
    public function index(RepositoryContatoRepository $contatoRepository): Response
    {
        return $this->render('contato/index.html.twig', [
            'contatos' => $contatoRepository->findAll(),
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/lite', name: 'contato_index_lite', methods: ['GET'])]
    public function lite(RepositoryContatoRepository $contatoRepository, Request $request): Response
    {
        return $this->render('contato/lite.html.twig', [
            'contatos' => $contatoRepository->findAll(),
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Cursos',
            'admin'=>$request->get('admin')
        ]);
    }

    #[Route('/new', name: 'contato_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contato = new Contato();
        $form = $this->createForm(ContatoType::class, $contato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contato);
            $entityManager->flush();

            return $this->redirectToRoute('contato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contato/new.html.twig', [
            'contato' => $contato,
            'form' => $form,
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/sumit', name: 'contato_sumit', methods: ['GET', 'POST'])]
    public function submit(Request $request, MailerInterface $mailer): Response
    {


        $email = (new Email())
            
            ->from(new Address($request->get('email'), $request->get('name')))
            ->to('lutonda@gmail.com'/*'ispbengo@gmail.com'*/)
            ->cc('info@ispbengo.ao')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('PORTAL ISPBENGO :: '.$request->get('subject'))
            ->text($request->get('message'))
            ->html($request->get('message'));

       $sent= $mailer->send($email);
        

        return $this->redirectToRoute('contactos',['success'=>$sent==null ? 'true':'false']);
    }

    #[Route('/{id}', name: 'contato_show', methods: ['GET'])]
    public function show(Contato $contato): Response
    {
        return $this->render('contato/show.html.twig', [
            'contato' => $contato,
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/{id}/edit', name: 'contato_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contato $contato, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContatoType::class, $contato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('contato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('contato/edit.html.twig', [
            'contato' => $contato,
            'form' => $form,
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/{id}', name: 'contato_delete', methods: ['POST'])]
    public function delete(Request $request, Contato $contato, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contato->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contato);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contato_index', [], Response::HTTP_SEE_OTHER);
    }
}
