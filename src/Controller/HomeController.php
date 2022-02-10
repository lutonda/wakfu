<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
            $cursos=[
                ['Tecnologia de Transformação Agroalimentar','Ciências Agrárias',5,5,200],
                ['Agronomia','Ciências Agrárias',4,3,200],
                ['Zootecnia','Ciências Agrárias',4,5,200],
                
                ['Engenharia Mecânica','Engenharia e Tecnologia',5,5,200],
                ['Engenharia Industrial','Engenharia e Tecnologia',4,5,200],
                ['Energia e Instalações Elétricas','Engenharia e Tecnologia',4,5,200],
                
                ['Gestão e Negócios','Administração e Negócios',4,5,200],
                ['Gestão Industrial','Administração e Negócios',3,5,200],
                
            ];
        return $this->render('home/index.html.twig', [

            'controller_name' => 'HomeController',
            'cursos'=>$cursos
        ]);
    }
}
