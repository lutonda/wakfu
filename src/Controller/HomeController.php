<?php

namespace App\Controller;

use App\Repository\CursoRepository;
use App\Repository\DepartamentoRepository;
use App\Repository\InstituicionalRepository;
use App\Repository\NoticiaRepository;
use App\Repository\SobreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        DepartamentoRepository $departamentoRepository, 
        CursoRepository $cursoRepository, 
        SobreRepository $sobreRepository,
        InstituicionalRepository $instituicionalRepository,
        NoticiaRepository $noticiaRepository): Response
    {
        $cursos=$cursoRepository->findBy(['isactive'=>true]);
        $departamentos=$departamentoRepository->findBy(['isactive'=>true]);
        
        return $this->render('home/index.html.twig', [
            'sobre'=>$sobreRepository->findAll()[0],
            'instituicional'=>$instituicionalRepository->findAll()[0],
            'noticias'=>$noticiaRepository->findAll(),
            
            'controller_name' => 'HomeController',
            'cursos'=>$cursos,
            'departamentos'=>$departamentos
        ]);
    }
    #[Route('/sobre', name: 'sobre')]
    public function about(DepartamentoRepository $departamentoRepository, CursoRepository $cursoRepository,SobreRepository $sobreRepository): Response
    {
        $sobre=$sobreRepository->findAll()[0];
        $cursos=$cursoRepository->findBy(['isactive'=>true]);
        $departamentos=$departamentoRepository->findBy(['isactive'=>true]);
        
        return $this->render('home/sobre.html.twig', [

            'controller_name' => 'HomeController',
            
            'title'=>'Sobre Nós',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',

            'sobre'=>$sobre,
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
