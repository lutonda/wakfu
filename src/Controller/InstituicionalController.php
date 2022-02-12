<?php

namespace App\Controller;

use App\Repository\CursoRepository;
use App\Repository\DepartamentoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/instituicional')]
class InstituicionalController extends AbstractController
{
    #[Route('/', name: 'instituicional')]
    public function index(DepartamentoRepository $departamentoRepository, CursoRepository $cursoRepository): Response
    {
        $cursos=$cursoRepository->findBy(['isactive'=>true]);
        $departamentos=$departamentoRepository->findBy(['isactive'=>true]);
        
        return $this->render('instituicional/instituicional.html.twig', [

            'title'=>'Instituicional',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',


            'controller_name' => 'HomeController',
            'cursos'=>$cursos,
            'departamentos'=>$departamentos
        ]);
    }
    #[Route('/historia', name: 'historia')]
    public function historia(DepartamentoRepository $departamentoRepository, CursoRepository $cursoRepository): Response
    {
        $cursos=$cursoRepository->findBy(['isactive'=>true]);
        $departamentos=$departamentoRepository->findBy(['isactive'=>true]);
        
        return $this->render('instituicional/historia.html.twig', [

            'controller_name' => 'HomeController',
            
            'title'=>'História',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',

            'cursos'=>$cursos,
            'departamentos'=>$departamentos
        ]);
    }
    #[Route('/contactos', name: 'contactos')]
    public function contacts(DepartamentoRepository $departamentoRepository, CursoRepository $cursoRepository): Response
    {
        $cursos=$cursoRepository->findBy(['isactive'=>true]);
        $departamentos=$departamentoRepository->findBy(['isactive'=>true]);
        
        return $this->render('home/contactos.html.twig', [

            'controller_name' => 'HomeController',

            'title'=>'Contactos',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',

            'cursos'=>$cursos,
            'departamentos'=>$departamentos
        ]);
    }
}
