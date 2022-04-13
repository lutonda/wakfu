<?php

namespace App\Controller;

use App\Entity\Noticia;
use App\Form\NoticiaType;
use App\Repository\NoticiaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
            'title'=>'Notícias',
            'subtitle'=>'***'
        ]);
    }

    #[Route('/new', name: 'noticia_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $noticium = new Noticia();
        $form = $this->createForm(NoticiaType::class, $noticium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagemFile = $form->get('imagem')->getData();

            // this condition is needed because the 'imagem' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imagemFile) {
                $newFilename = uniqid().'.'.$imagemFile->guessExtension();
                
                // Move the file to the directory where imagems are stored
                try {
                    $imagemFile->move(
                        $this->getParameter('uploads_directory').'Noticia',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imagemFilename' property to store the PDF file name
                // instead of its contents
                $noticium->setImagem($newFilename);
            }
            $entityManager->persist($noticium);
            $entityManager->flush();

            return $this->redirectToRoute('noticia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticia/new.html.twig', [
            'noticium' => $noticium,
            'form' => $form,
            'title'=>'Notícias',
            'subtitle'=>'***'
        ]);
    }
    
    #[Route('/lite', name: 'noticia_index_lite', methods: ['GET', 'POST'])]
    public function lite(NoticiaRepository $noticiaRepository): Response
    {
        return $this->render('noticia/lite.html.twig', [
            'noticias' => $noticiaRepository->findAll(),
            'title'=>'Notícias',
            'subtitle'=>'***'
        ]);
    }

    #[Route('/{id}', name: 'noticia_show', methods: ['GET'])]
    public function show(Noticia $noticium): Response
    {
        return $this->render('noticia/show.html.twig', [
            'noticium' => $noticium,
            'title'=>'Notícias',
            'subtitle'=>$noticium->getTitulo()
        ]);
    }

    #[Route('/{id}/edit', name: 'noticia_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Noticia $noticium, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NoticiaType::class, $noticium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldFileName=$noticium->getImagem();
            $imagemFile = $form->get('imagem')->getData();

            // this condition is needed because the 'imagem' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imagemFile) {
                $newFilename = uniqid().'.'.$imagemFile->guessExtension();
                
                // Move the file to the directory where imagems are stored
                try {
                    $imagemFile->move(
                        $this->getParameter('uploads_directory').'Noticia',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imagemFilename' property to store the PDF file name
                // instead of its contents
                $noticium->setImagem($newFilename);
            }
            if($entityManager->flush()){
                if($oldFileName!==$noticium->getImagem())
                    unlink($this->getParameter('uploads_directory').'Noticia/'.$oldFileName);
            }

            return $this->redirectToRoute('noticia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('noticia/edit.html.twig', [
            'noticium' => $noticium,
            'form' => $form,
            'title'=>'Notícias',
            'subtitle'=>'***'
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
