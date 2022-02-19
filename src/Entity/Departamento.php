<?php

namespace App\Entity;

use App\Repository\DepartamentoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: DepartamentoRepository::class)]
class Departamento
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string')]
    private $texto;

    #[ORM\Column(type: 'text')]
    private $text;

    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[ORM\ManyToOne(targetEntity: 'Pessoa')]
    private $coordenador;

    #[ORM\Column(type: 'string')]
    private $code;

    #[ORM\Column(type: 'text')]
    private $imagem;
    
    #[ORM\Column(type: 'string')]
    private $icon;
    
    #[ORM\Column(type: 'datetime', options:["default"=> "CURRENT_TIMESTAMP"])]
    protected $created;  

    #[ORM\Column(type:'boolean')]
    protected $isactive=true;  

    #[ORM\OneToMany(targetEntity:'Curso', mappedBy:'departamento')]
    protected $cursos;  

    public function __construct()
    {
        $this->created=new   \DateTime();
    }
    public function getId()
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): self
    {
        $this->texto = $texto;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCoordenador()
    {
        return $this->coordenador;
    }

    public function setCoordenador($coordenador): self
    {
        $this->coordenador = $coordenador;

        return $this;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }
    public function isIsactive(): ?bool
    {
        return $this->isactive;
    }

    public function setIsactive(int $isactive): self
    {
        $this->isactive = $isactive;

        return $this;
    }
    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated(int $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon): self
    {
        $this->icon = $icon;

        return $this;
    }
    public function getImagem()
    {
        return $this->imagem;
    }

    public function setImagem($imagem): self
    {
        $this->imagem = $imagem;

        return $this;
    }
    public function getCursos()
    {
        return $this->cursos;
    }

    public function setCursos($cursos): self
    {
        $this->cursos = $cursos;

        return $this;
    }
}
