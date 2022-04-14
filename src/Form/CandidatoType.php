<?php

namespace App\Form;

use App\Entity\Candidato;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class CandidatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomeCompleto')
            ->add('dataNascimento', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('numeroDocumentoIdentificacao')
            ->add('residencia')
            ->add('areaFormacao')
            ->add('instituicao')
            ->add('grauAcademico', ChoiceType::class, [
                "choices" => ["Doutor","Mestre","Licenciado"],
                "choice_label" => function($key, $index) {
                    return $key;
                },
                "expanded" => true,
                "multiple" => false,
                "required" => true,
                "label" => "Grau Academico",
            ])
            ->add('categoria', ChoiceType::class, [
                "choices" => ["Assistente","Assistente Estagiário"],
                "choice_label" => function($key, $index) {
                    return $key;
                },
                "expanded" => true,
                "multiple" => false,
                "required" => true,
                "label" => "Categoria que se candidata",
            ])
            ->add('area', ChoiceType::class, [
                "choices" => [
                    "Engenharia de Tecnologia Agro-alimentar"
                    ,"Metodologia de Investigação Científica"
                    ,"Biologia"
                    ,"Lingua Portuguesa"
                    ,"Engenharia Industrial"
                    ,"Energia Agrónoma"
                    ,"Física"
                ],
                "choice_label" => function($key, $index) {
                    return $key;
                },
                "expanded" => true,
                "multiple" => false,
                "required" => true,
                "label" => "Area a qual se candidata",
            ])
            ->add('requerimento', FileType::class, [
                'label' => '
                Clique no link para visualizar o modelo de requerimento: https://drive.google.com/file/d/1SK-h66aUoSMpWgo_bMciDZC9aD-N2sQI/view?usp=sharing
                (PDF)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'application/pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid pdf file',
                    ])
                ],
            ])
            ->add('curriculum', FileType::class, [
                'label' => 'Inserir os documentos na seguinte ordem: Curriculum, Cópia do documento de Identificação, Certificado de Habilitações, Diploma, e outros documentos que comprovam as informações do curriculum.
                (PDF)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'application/pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid pdf file',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidato::class,
        ]);
    }
}
