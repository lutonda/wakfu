<?php

namespace App\Form;

use App\Entity\Candidatura;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidaturaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pessoa', PessoaType::class, array(
                'label'=>'Dados Pessoais',
                )
            )
            ->add('numero_documento_identificacao')
            ->add('data_nascimento')
            ->add('area_formacao')
            ->add('instituicao')
            ->add('requerimento')
            ->add('curriculum')
            ->add('documento_identificacao')
            ->add('certificado_habilitacao')
            ->add('diploma')
            ->add('outros')
            ->add('estado')
            ->add('active')

            ->add('endereco')
            ->add('grau_academico')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidatura::class,
        ]);
    }
}
