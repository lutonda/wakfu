<?php

namespace App\Form;

use App\Entity\Departamento;
use App\Entity\VagaEmprego;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VagaEmpregoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('area')
            ->add('categoria')
            ->add('codigo')
            ->add('area')
            ->add('data_inicio')
            ->add('data_fim')
            ->add('quantidade')
            ->add('departamento',EntityType::class, array(
                'class' => Departamento::class,
                'choice_label' => 'titulo'))
                
            ->add('descricao')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VagaEmprego::class,
        ]);
    }
}
