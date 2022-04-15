<?php

namespace App\Form;

use App\Entity\Candidato;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\File;

class CandidatoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomeCompleto'
            ,null,[
                'label'=>"Nome Completo"
            ]
            )
            ->add('email', EmailType::class)
            ->add('dataNascimento', DateType::class, [
                'widget' => 'single_text',
                'label'=>"Data de Nascimento"
            ])
            ->add('numeroDocumentoIdentificacao',TextType::class,[
                'label'=>"Número do Documento Identificação"
            ])
            ->add('residencia',TextType::class,[
                'label'=>"Residência"
            ])
            ->add('areaFormacao',TextType::class,[
                'label'=>"Área de Formação"
            ])
            ->add('instituicao',TextType::class,[
                'label'=>"Instituição"
            ])
            ->add('grauAcademico', ChoiceType::class, [
                "label"=>"Grau Académico",
                "choices" => ["Doutor","Mestre","Licenciado"],
                "choice_label" => function($key, $index) {
                    return $key;
                },
                "expanded" => true,
                "multiple" => false,
                "required" => true,
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
                    "Biologia (Ciências)"
                    ,"Química (Ciências)"
                    ,"Física (Ciências)"
                    ,"Medicina Veterinária"
                    ,"Matemática"
                    ,"Metodologia de Investigação Científica"
                    ,"Línguas"
                    ,"Engenharia Industrial"
                    ,"Agronomia"
                    ,"Engenharia de Tecnologia Agroalimentar"
                     
                ],
                "choice_label" => function($key, $index) {
                    return $key;
                },
                "expanded" => true,
                "multiple" => false,
                "required" => true,
                "label" => "Área a qual se candidata",
            ])
            ->add('requerimento', FileType::class, [
                'label' => 'Inserir Requerimento (PDF)<br/> Clique no link para visualizar o modelo de requerimento:<br><a target="_blank" href="https://drive.google.com/file/d/1SK-h66aUoSMpWgo_bMciDZC9aD-N2sQI/view?usp=sharing">https://drive.google.com/file/d/1SK-h66aUoSMpWgo_bMciDZC9aD-N2sQI/view?usp=sharing</a>',
                'label_html'=> true,
                'label_attr'=>['label_html'=> true],
                'attr'=>['accept'=>"application/pdf"],
                //
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => true,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '10m',
                        'mimeTypes' => [
                            'application/pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid pdf file',
                    ])
                ],
            ])
            ->add('curriculum', FileType::class, [
                'label' => 'Inserir os documentos na seguinte ordem(PDF):<ol><li>Curriculum, <li>Cópia do Bilhete de Identidade, <li>Certificado de Habilitações, <li>Declaração de reconhecimento de estudos pelo INAREES, <li>Cópia de documentos mencionados no Curriculum.</ol>
                ',
                'label_html'=> true,
                'attr'=>['accept'=>"application/pdf"],
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => true,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '10m',
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
