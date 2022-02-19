<?php

namespace App\Controller;

use App\Entity\Galeria;
use App\Form\GaleriaType;
use App\Repository\GaleriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/galeria')]
class GaleriaController extends AbstractController
{
    #[Route('/', name: 'galeria_index', methods: ['GET'])]
    public function index(GaleriaRepository $galeriaRepository): Response
    {
        return $this->render('galeria/index.html.twig', [
            'galerias' => $galeriaRepository->findAll(),
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/new', name: 'galeria_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $galeria = new Galeria();
        $form = $this->createForm(GaleriaType::class, $galeria);
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
                        $this->getParameter('uploads_directory').'Galeria',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imagemFilename' property to store the PDF file name
                // instead of its contents
                $galeria->setImagem($newFilename);
            }
            $entityManager->persist($galeria);
            $entityManager->flush();

            return $this->redirectToRoute('galeria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('galeria/new.html.twig', [
            'galeria' => $galeria,
            'form' => $form,
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Cursos'
        ]);
    }

    #[Route('/{id}', name: 'galeria_show', methods: ['GET'])]
    public function show(Galeria $galeria): Response
    {
        return $this->render('galeria/show.html.twig', [
            'galeria' => $galeria,
        ]);
    }

    #[Route('/{id}/edit', name: 'galeria_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Galeria $galeria, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GaleriaType::class, $galeria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldFileName=$galeria->getImagem();
            $imagemFile = $form->get('imagem')->getData();

            // this condition is needed because the 'imagem' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imagemFile) {
                $newFilename = uniqid().'.'.$imagemFile->guessExtension();
                
                // Move the file to the directory where imagems are stored
                try {
                    $imagemFile->move(
                        $this->getParameter('uploads_directory').'Galeria',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imagemFilename' property to store the PDF file name
                // instead of its contents
                $galeria->setImagem($newFilename);
            }
            if($entityManager->flush()){
                if($oldFileName!==$galeria->getImagem())
                    unlink($this->getParameter('uploads_directory').'Galeria/'.$oldFileName);
            }

            return $this->redirectToRoute('galeria_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('galeria/edit.html.twig', [
            'galeria' => $galeria,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'galeria_delete', methods: ['POST'])]
    public function delete(Request $request, Galeria $galeria, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$galeria->getId(), $request->request->get('_token'))) {
            $entityManager->remove($galeria);
            $entityManager->flush();
        }

        return $this->redirectToRoute('galeria_index', [], Response::HTTP_SEE_OTHER);
    }
}
