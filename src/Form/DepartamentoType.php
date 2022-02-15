<?php

namespace App\Form;

use App\Entity\Departamento;
use App\Entity\Pessoa;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepartamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titulo')
        ->add('texto')
            ->add('code')
            ->add('imagem')
            ->add('icon')
            ->add('isactive')
           /* ->add('pessoas',EntityType::class, array(
                'label'=>'Coordenador',
                'class' => Pessoa::class,
                'choice_label' => 'nome'))
                */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Departamento::class,
        ]);
    }
}
