<?php

namespace App\Controller;

use App\Entity\Departamento;
use App\Form\DepartamentoType;
use App\Repository\DepartamentoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/departamento')]
class DepartamentoController extends AbstractController
{
    #[Route('/', name: 'departamento_index', methods: ['GET'])]
    public function index(DepartamentoRepository $departamentoRepository): Response
    {
        return $this->render('departamento/index.html.twig', [
            'departamentos' => $departamentoRepository->findAll(),
            'title'=>'Departamentos',
            'subtitle'=>'Nossa variedade de Departamentos'
        ]);
    }

    
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'departamento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $departamento = new Departamento();
        $form = $this->createForm(DepartamentoType::class, $departamento);
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
                        $this->getParameter('uploads_directory').'Departamento',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imagemFilename' property to store the PDF file name
                // instead of its contents
                $departamento->setImagem($newFilename);
            }
            $entityManager->persist($departamento);
            $entityManager->flush();

            return $this->redirectToRoute('departamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('departamento/new.html.twig', [
            'departamento' => $departamento,
            'form' => $form,
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Departamentos'
        ]);
    }

    #[Route('/{id}', name: 'departamento_show', methods: ['GET'])]
    public function show(Departamento $departamento): Response
    {
        return $this->render('departamento/show.html.twig', [
            'departamento' => $departamento,
            'title'=>'Departamentos',
            'subtitle'=>$departamento->getTexto().' '.$departamento->getTitulo()
        ]);
    }

    
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'departamento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Departamento $departamento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DepartamentoType::class, $departamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldFileName=$departamento->getImagem();
            $imagemFile = $form->get('imagem')->getData();

            // this condition is needed because the 'imagem' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imagemFile) {
                $newFilename = uniqid().'.'.$imagemFile->guessExtension();
                
                // Move the file to the directory where imagems are stored
                try {
                    $imagemFile->move(
                        $this->getParameter('uploads_directory').'Departamento',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imagemFilename' property to store the PDF file name
                // instead of its contents
                $departamento->setImagem($newFilename);
            }
            if($entityManager->flush()){
                if($oldFileName!==$departamento->getImagem())
                    unlink($this->getParameter('uploads_directory').'Departamento/'.$oldFileName);
            }
            return $this->redirectToRoute('departamento_show', ['id'=>$departamento->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('departamento/edit.html.twig', [
            'departamento' => $departamento,
            'form' => $form,
            'title'=>'Galeria de fotos',
            'subtitle'=>'Nossa variedade de Departamentos'
        ]);
    }

    
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'departamento_delete', methods: ['POST'])]
    public function delete(Request $request, Departamento $departamento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$departamento->getId(), $request->request->get('_token'))) {
            //$entityManager->remove($departamento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('departamento_index', [], Response::HTTP_SEE_OTHER);
    }
}
