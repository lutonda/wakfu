<?php

namespace App\Form;

use App\Entity\Departamento;
use App\Entity\Pessoa;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class DepartamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titulo')
        ->add('texto')
        ->add('text')
            ->add('code')
            ->add('icon')
            ->add('isactive')
            
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
            ->add('coordenador',EntityType::class, array(
                'class' => Pessoa::class,
                'choice_label' => 'nome'))
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
