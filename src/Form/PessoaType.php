<?php

namespace App\Form;

use App\Entity\Pessoa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PessoaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('linkedin')
            ->add('titulo')
            ->add('descricao')
            ->add('imagem')
            ->add('icon')
            ->add('created')
            ->add('isactive')
            ->add('tags')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pessoa::class,
        ]);
    }
}
