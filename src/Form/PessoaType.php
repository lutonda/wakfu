<?php

namespace App\Form;

use App\Entity\Pessoa;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class PessoaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('nome')
            ->add('descricao')
            ->add('linkedin')
            ->add('imagem')
            ->add('isactive')
            ->add('tags',EntityType::class, array(
                'class' => Tag::class,
                'multiple' => true,
                'choice_label' => 'nome'))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pessoa::class,
        ]);
    }
}
