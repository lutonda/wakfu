<?php

namespace App\Form;

use App\Entity\Noticia;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoticiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('text')
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
            'data_class' => Noticia::class,
        ]);
    }
}
