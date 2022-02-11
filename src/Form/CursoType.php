<?php

namespace App\Form;

use App\Entity\Curso;
use App\Entity\Departamento;
use App\Entity\Lingua;
use App\Entity\Periodo;
use App\Entity\Pessoa;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CursoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('duracao')
            ->add('apresentacao')
            ->add('saida')
            ->add('condicoes')
            ->add('plano')
            ->add('icon')
            ->add('imagem')
            ->add('code')
            ->add('isactive')
            ->add('departamento',EntityType::class, array(
                'class' => Departamento::class,
                'choice_label' => 'titulo'))
            ->add('periodo',EntityType::class, array(
                'class' => Periodo::class,
                'multiple' => true,
                'choice_label' => 'nome'))
            ->add('lingua',EntityType::class, array(
                'class' => Lingua::class,
                'multiple' => true,
                'choice_label' => 'nome'))
            ->add('coordenador',EntityType::class, array(
                'class' => Pessoa::class,
                'choice_label' => 'nome'))
            ->add('tags',EntityType::class, array(
                'class' => Tag::class,
                'multiple' => true,
                'choice_label' => 'nome'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Curso::class,
        ]);
    }
}
