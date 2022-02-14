<?php

namespace App\Controller;

use App\Repository\CursoRepository;
use App\Repository\DepartamentoRepository;
use App\Repository\TimeLineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/componentes')]
class DefaultController extends AbstractController
{
    #[Route('/timeline', name: 'timeline')]
    public function timeline(TimeLineRepository $timeLineRepository, Request $request): Response
    {
        return $this->render('components/timeline.html.twig', [
		    'admin'=>$request->get('admin') ,
            'timelines'=>$timeLineRepository->findBy(['active'=>true],['ano'=>'ASC']),
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/sobre', name: 'sobre')]
    public function about(DepartamentoRepository $departamentoRepository, CursoRepository $cursoRepository): Response
    {
        $cursos=$cursoRepository->findBy(['isactive'=>true]);
        $departamentos=$departamentoRepository->findBy(['isactive'=>true]);
        
        return $this->render('home/sobre.html.twig', [

            'controller_name' => 'HomeController',
            
            'title'=>'Sobre Nós',
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
