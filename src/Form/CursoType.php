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

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('imagem', FileType::class, [
                'label' => 'Imagem (Jpg ou png file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid Jpg or PNG Imagem',
                    ])
                ],
            ])

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
