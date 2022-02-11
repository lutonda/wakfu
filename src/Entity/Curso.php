<?php

namespace App\Entity;

use App\Repository\CursoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CursoRepository::class)]
class Curso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid')]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[ORM\ManyToOne(targetEntity: 'Departamento')]
    private $departamento;

    #[ORM\Column(type: 'integer')]
    private $duracao;

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
    protected $isactive;  

    #[ORM\ManyToMany(targetEntity: 'Tag')]
    private $tags;

    public function getId(): ?int
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

    public function getCoordenador(): ?Pessoa
    {
        return $this->coordenador;
    }

    public function setCoordenador(?Pessoa $coordenador): self
    {
        $this->coordenador = $coordenador;

        return $this;
    }
}
