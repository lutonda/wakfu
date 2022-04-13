<?php

namespace App\Controller;

use App\Repository\CursoRepository;
use App\Repository\DepartamentoRepository;
use App\Repository\InstituicionalRepository;
use App\Repository\SobreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/instituicional')]
class InstituicionalController extends AbstractController
{
    #[Route('/', name: 'instituicional_index')]
    public function index(DepartamentoRepository $departamentoRepository, SobreRepository $sobreRepository, InstituicionalRepository $instituicionalRepository): Response
    {
        
        $departamentos=$departamentoRepository->findBy(['isactive'=>true]);
        $instituicional=$instituicionalRepository->findAll()[0];
        $sobre=$sobreRepository->findAll()[0];
        return $this->render('instituicional/instituicional.html.twig', [

            'title'=>'Instituicional',
            'subtitle'=>'Fale connosco com as masi deversas formas de contactos',


            'controller_name' => 'HomeController',
            'sobre'=>$sobre,
            'departamentos'=>$departamentos,
            'instituicional'=>$instituicional

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
    
    #[Route('/contact/sumit', name: 'contato_sumit', methods: ['GET', 'POST'])]
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

}
