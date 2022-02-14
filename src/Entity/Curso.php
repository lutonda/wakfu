<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
class Curso
{
    
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[ORM\ManyToOne(targetEntity: 'Departamento')]
    private $departamento;

    #[ORM\Column(type: 'integer')]
    private $duracao;

    #[ORM\Column(type: 'integer')]
    private $vagas=10;

    #[ORM\Column(type: 'integer')]
    private $turmas=1;

    #[ORM\Column(type: 'integer')]
    private $pontos=1;

    #[ORM\ManyToMany(targetEntity: 'Periodo')]
    private $periodo;

    #[ORM\ManyToMany(targetEntity: 'Lingua')]
    private $lingua;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private $apresentacao;

    #[ORM\Column(type: 'text', nullable: true)]
    private $saida;

    #[ORM\Column(type: 'text')]
    private $condicoes;

    #[ORM\Column(type: 'text')]
    private $plano;

    #[ORM\Column(type: 'string')]
    private $icon;

    #[ORM\Column(type: 'text')]
    private $imagem;

    #[ORM\ManyToOne(targetEntity: 'Pessoa')]
    private $coordenador;

    #[ORM\Column(type: 'string')]
    private $code;

    #[ORM\Column(type: 'datetime', options:["default"=> "CURRENT_TIMESTAMP"])]
    protected $created;  

    #[ORM\Column(type:'boolean')]
    protected $isactive=true;  

    #[ORM\ManyToMany(targetEntity: 'Tag')]
    private $tags;

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

    public function getDepartamento(): ?Departamento
    {
        return $this->departamento;
    }

    public function setDepartamento(Departamento $departamento): self
    {
        $this->departamento = $departamento;

        return $this;
    }

    public function getDuracao(): ?int
    {
        return $this->duracao;
    }

    public function setDuracao(int $duracao): self
    {
        $this->duracao = $duracao;

        return $this;
    }

    public function getVagas(): ?int
    {
        return $this->vagas;
    }

    public function setVagas(int $vagas): self
    {
        $this->vagas = $vagas;

        return $this;
    }

    public function getTurmas(): ?int
    {
        return $this->turmas;
    }

    public function setTurmas(int $turmas): self
    {
        $this->turmas = $turmas;

        return $this;
    }

    public function getPontos(): ?int
    {
        return $this->pontos;
    }

    public function setPontos(int $pontos): self
    {
        $this->pontos = $pontos;

        return $this;
    }

    public function getPeriodo()
    {
        return $this->periodo;
    }

    public function setPeriodo($periodo): self
    {
        $this->periodo = $periodo;

        return $this;
    }

    public function getLingua()
    {
        return $this->lingua;
    }

    public function setLingua($lingua): self
    {
        $this->lingua = $lingua;

        return $this;
    }

    public function getApresentacao(): ?string
    {
        return $this->apresentacao;
    }

    public function setApresentacao(?string $apresentacao): self
    {
        $this->apresentacao = $apresentacao;

        return $this;
    }

    public function getSaida(): ?string
    {
        return $this->saida;
    }

    public function setSaida(?string $saida): self
    {
        $this->saida = $saida;

        return $this;
    }

    public function getCondicoes(): ?string
    {
        return $this->condicoes;
    }

    public function setCondicoes(string $condicoes): self
    {
        $this->condicoes = $condicoes;

        return $this;
    }

    public function getPlano(): ?string
    {
        return $this->plano;
    }

    public function setPlano(string $plano): self
    {
        $this->plano = $plano;

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
    
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon($icon): self
    {
        $this->icon = $icon;

        return $this;
    }
    public function getImagem(): ?string
    {
        return $this->imagem;
    }

    public function setImagem($imagem): self
    {
        $this->imagem = $imagem;

        return $this;
    }
    
    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }

    
    public function getTags()
    {
        return $this->tags;
    }
    public function setTags($tags): self
    {
        $this->tags = $tags;

        return $this;
    }
    
    public function getCreated():DateTime
    {
        return $this->created;
    }
    public function setcreated($created): self
    {
        $this->created = $created;

        return $this;
    }
    
    public function isActive():bool
    {
        return $this->isactive ? true : false;
    }
    public function setIsactive($isactive): self
    {
        $this->isactive = $isactive;

        return $this;
    }
}
