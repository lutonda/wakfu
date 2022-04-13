<?php

namespace App\Controller;

use App\Entity\Instituicional;
use App\Form\InstituicionalType;
use App\Repository\InstituicionalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/instituicionais')]
class InstituicionaisController extends AbstractController
{
    #[Route('/', name: 'instituicionais_index', methods: ['GET'])]
    public function index(InstituicionalRepository $instituicionalRepository): Response
    {
        return $this->render('instituicionais/index.html.twig', [
            'instituicionals' => $instituicionalRepository->findAll(),
            'title'=>'Instituicional',
            'subtitle'=>''//'Fale connosco com as masi deversas formas de contactos',

        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'instituicionais_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $instituicional = new Instituicional();
        $form = $this->createForm(InstituicionalType::class, $instituicional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $instituicional->setImagemA($this->createImage($form->get('imagemA')->getData()));
            $instituicional->setImagemB($this->createImage($form->get('imagemB')->getData()));
            $instituicional->setImagemC($this->createImage($form->get('imagemC')->getData()));
        
            $entityManager->persist($instituicional);
            $entityManager->flush();

            return $this->redirectToRoute('instituicional_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instituicionais/new.html.twig', [
            'instituicional' => $instituicional,
            'form' => $form,
            'title'=>'Instituicional',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',

        ]);
    }

    #[Route('/{id}', name: 'instituicionais_show', methods: ['GET'])]
    public function show(Instituicional $instituicional): Response
    {
        return $this->render('instituicionais/show.html.twig', [
            'instituicional' => $instituicional,
            'title'=>'Instituicional',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',

        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'instituicionais_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Instituicional $instituicional, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InstituicionalType::class, $instituicional);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($entityManager->flush()){
                
                $instituicional->setImagemA($this->updateImage($form->get('imagemA')->getData(),$instituicional->getImagemA()));
                $instituicional->setImagemB($this->updateImage($form->get('imagemB')->getData(),$instituicional->getImagemB()));
                $instituicional->setImagemC($this->updateImage($form->get('imagemC')->getData(),$instituicional->getImagemC()));

            $entityManager->flush();
            }
        
            

            return $this->redirectToRoute('instituicional_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instituicionais/edit.html.twig', [
            'instituicional' => $instituicional,
            'form' => $form,
            'title'=>'Instituicional',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',

        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'instituicionais_delete', methods: ['POST'])]
    public function delete(Request $request, Instituicional $instituicional, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instituicional->getId(), $request->request->get('_token'))) {
           // $entityManager->remove($instituicional);
            $entityManager->flush();
        }

        return $this->redirectToRoute('instituicionais_index', [], Response::HTTP_SEE_OTHER);
    }

    
    private function updateImage($imagemFile,$oldFileName){
            // this condition is needed because the 'imagem' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imagemFile) {
                $newFilename = uniqid().'.'.$imagemFile->guessExtension();
                
                // Move the file to the directory where imagems are stored
                try {
                    $imagemFile->move(
                        $this->getParameter('uploads_directory').'Instituicional',
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imagemFilename' property to store the PDF file name
                // instead of its contents
                return $newFilename;
                unlink($this->getParameter('uploads_directory').'Instituicional/'.$oldFileName);
            }
        return $oldFileName;
        
    }
    private function createImage($imagemFile){
        // this condition is needed because the 'imagem' field is not required
        // so the PDF file must be processed only when a file is uploaded
        if ($imagemFile) {
            $newFilename = uniqid().'.'.$imagemFile->guessExtension();
            
            // Move the file to the directory where imagems are stored
            try {
                $imagemFile->move(
                    $this->getParameter('uploads_directory').'Instituicional',
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'imagemFilename' property to store the PDF file name
            // instead of its contents
        }
        
        return $newFilename;
    }
}
