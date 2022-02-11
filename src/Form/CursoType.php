<?php

namespace App\Form;

use App\Entity\Curso;
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
            ->add('created')
            ->add('isactive')
            ->add('departamento')
            ->add('periodo')
            ->add('lingua')
            ->add('coordenador')
            ->add('tags')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Curso::class,
        ]);
    }
}
