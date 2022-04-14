<?php

namespace App\Controller;

use App\Entity\Candidato;
use App\Form\CandidatoType;
use App\Repository\CandidatoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidato')]
class CandidatoController extends AbstractController
{
    #[Route('/', name: 'candidato_index', methods: ['GET'])]
    public function index(CandidatoRepository $candidatoRepository): Response
    {
        return $this->render('candidato/index.html.twig', [
            'candidatos' => $candidatoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'candidato_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $candidato = new Candidato();
        $form = $this->createForm(CandidatoType::class, $candidato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagemFile = $form->get('requerimento')->getData();

            // this condition is needed because the 'imagem' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imagemFile) {
                
                $newFilename = uniqid().'.requerimento.'.$imagemFile->guessExtension();

                // Move the file to the directory where imagems are stored
                try {
                    $imagemFile->move(
                        $this->getParameter('uploads_directory').'Candidatura',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imagemFilename' property to store the PDF file name
                // instead of its contents
                $candidato->setRequerimento($newFilename);
            }

            $imagemFile = $form->get('curriculum')->getData();

            // this condition is needed because the 'imagem' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imagemFile) {
                
                $newFilename = uniqid().'.curriculum.'.$imagemFile->guessExtension();

                // Move the file to the directory where imagems are stored
                try {
                    $imagemFile->move(
                        $this->getParameter('uploads_directory').'Candidatura',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imagemFilename' property to store the PDF file name
                // instead of its contents
                $candidato->setCurriculum($newFilename);
            }
            
            $entityManager->persist($candidato);
            $entityManager->flush();

            return $this->redirectToRoute('candidato_new', ['success'=>true], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidato/new.html.twig', [
            'candidato' => $candidato,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'candidato_show', methods: ['GET'])]
    public function show(Candidato $candidato): Response
    {
        return $this->render('candidato/show.html.twig', [
            'candidato' => $candidato,
        ]);
    }

    #[Route('/{id}/edit', name: 'candidato_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidato $candidato, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CandidatoType::class, $candidato);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('candidato_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('candidato/edit.html.twig', [
            'candidato' => $candidato,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'candidato_delete', methods: ['POST'])]
    public function delete(Request $request, Candidato $candidato, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidato->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidato);
            $entityManager->flush();
        }

        return $this->redirectToRoute('candidato_index', [], Response::HTTP_SEE_OTHER);
    }
}
