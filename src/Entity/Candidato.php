<?php

namespace App\Entity;

use App\Repository\CandidatoRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: CandidatoRepository::class)]
class Candidato
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomeCompleto;

    #[ORM\Column(type: 'integer')]
    private $numero;

    #[ORM\Column(type: 'date')]
    private $dataNascimento;

    #[ORM\Column(type: 'string', length: 255)]
    private $numeroDocumentoIdentificacao;

    #[ORM\Column(type: 'string', length: 255)]
    private $residencia;

    #[ORM\Column(type: 'string', length: 255)]
    private $areaFormacao;

    #[ORM\Column(type: 'string', length: 255)]
    private $instituicao;

    #[ORM\Column(type: 'string', length: 255)]
    private $grauAcademico;

    #[ORM\Column(type: 'string', length: 255)]
    private $categoria;

    #[ORM\Column(type: 'string', length: 255)]
    private $area;

    #[ORM\Column(type: 'string', length: 255)]
    private $requerimento;

    #[ORM\Column(type: 'string', length: 255)]
    private $curriculum;

    #[ORM\Column(type: 'datetime')]
    private $created;

    public function __construct()
    {
        $this->created=new DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumero()
    {
        return str_pad($this->numero, 6, "0", STR_PAD_LEFT);
    }

    public function getNomeCompleto(): ?string
    {
        return $this->nomeCompleto;
    }

    public function setNomeCompleto(string $nomeCompleto): self
    {
        $this->nomeCompleto = $nomeCompleto;

        return $this;
    }

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(\DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getNumeroDocumentoIdentificacao(): ?string
    {
        return $this->numeroDocumentoIdentificacao;
    }

    public function setNumeroDocumentoIdentificacao(string $numeroDocumentoIdentificacao): self
    {
        $this->numeroDocumentoIdentificacao = $numeroDocumentoIdentificacao;

        return $this;
    }

    public function getResidencia(): ?string
    {
        return $this->residencia;
    }

    public function setResidencia(string $residencia): self
    {
        $this->residencia = $residencia;

        return $this;
    }

    public function getAreaFormacao(): ?string
    {
        return $this->areaFormacao;
    }

    public function setAreaFormacao(string $areaFormacao): self
    {
        $this->areaFormacao = $areaFormacao;

        return $this;
    }

    public function getInstituicao(): ?string
    {
        return $this->instituicao;
    }

    public function setInstituicao(string $instituicao): self
    {
        $this->instituicao = $instituicao;

        return $this;
    }

    public function getGrauAcademico(): ?string
    {
        return $this->grauAcademico;
    }

    public function setGrauAcademico(string $grauAcademico): self
    {
        $this->grauAcademico = $grauAcademico;

        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getRequerimento(): ?string
    {
        return $this->requerimento;
    }

    public function setRequerimento(string $requerimento): self
    {
        $this->requerimento = $requerimento;

        return $this;
    }

    public function getCurriculum(): ?string
    {
        return $this->curriculum;
    }

    public function setCurriculum(string $curriculum): self
    {
        $this->curriculum = $curriculum;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
}
