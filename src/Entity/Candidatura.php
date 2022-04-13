<?php

namespace App\Entity;

use App\Repository\CandidaturaRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: CandidaturaRepository::class)]
class Candidatura
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    private $id;

    #[ORM\ManyToOne(targetEntity: 'Pessoa')]
    private $pessoa;

    #[ORM\Column(type: 'string', length: 255)]
    private $numero;

    #[ORM\Column(type: 'string', length: 255)]
    private $numero_documento_identificacao;

    #[ORM\Column(type: 'date', length: 255)]
    private $data_nascimento;

    #[ORM\ManyToOne(targetEntity: 'Endereco')]
    private $endereco;

    #[ORM\Column(type: 'string', length: 255)]
    private $area_formacao;

    #[ORM\Column(type: 'string', length: 255)]
    private $instituicao;

    #[ORM\ManyToOne(targetEntity: 'GrauAcademico')]
    private $grau_academico;

    #[ORM\Column(type: 'text')]
    private $requerimento;

    #[ORM\Column(type: 'text')]
    private $curriculum;

    #[ORM\Column(type: 'text')]
    private $documento_identificacao;

    #[ORM\Column(type: 'text')]
    private $certificado_habilitacao;

    #[ORM\Column(type: 'text')]
    private $diploma;

    #[ORM\Column(type: 'text')]
    private $outros;

    #[ORM\ManyToOne(targetEntity: 'VagaEmprego')]
    private $vaga;


    #[ORM\Column(type: 'integer')]
    private $estado;

    #[ORM\Column(type: 'datetime', options:["default"=> "CURRENT_TIMESTAMP"])]
    protected $created;  

    #[ORM\Column(type: 'boolean')]
    private $active=true;

    
    public function getId()
    {
        return $this->id;
    }

    public function getPessoa(): ?Pessoa
    {
        return $this->pessoa;
    }

    public function setPessoa($pessoa): self
    {
        $this->pessoa = $pessoa;

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

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
    
    public function getNumeroDocumentoIdentificacao(): ?string
    {
        return $this->numero_documento_identificacao;
    }

    public function setNumeroDocumentoIdentificacao(string $numero_documento_identificacao): self
    {
        $this->numero_documento_identificacao = $numero_documento_identificacao;

        return $this;
    }

    
    public function getDataNascimento(): ?string
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(string $data_nascimento): self
    {
        $this->data_nascimento = $data_nascimento;

        return $this;
    }

    
    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    
    public function getAreaFormacao(): ?string
    {
        return $this->area_formacao;
    }

    public function setAreaFormacao(string $area_formacao): self
    {
        $this->area_formacao = $area_formacao;

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
        return $this->grau_academico;
    }

    public function setGrauAcademico(string $grau_academico): self
    {
        $this->grau_academico = $grau_academico;

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

    public function getDocumentoIdentificacao(): ?string
    {
        return $this->documento_identificacao;
    }

    public function setDocumentoIdentificacao(string $documento_identificacao): self
    {
        $this->documento_identificacao = $documento_identificacao;

        return $this;
    }

    public function getCertificadoHabilitacao(): ?string
    {
        return $this->certificado_habilitacao;
    }

    public function setCertificadoHabilitacao(string $certificado_habilitacao): self
    {
        $this->certificado_habilitacao = $certificado_habilitacao;

        return $this;
    }

    public function getDiploma(): ?string
    {
        return $this->diploma;
    }

    public function setDiploma(string $diploma): self
    {
        $this->diploma = $diploma;

        return $this;
    }

    public function getOutros(): ?string
    {
        return $this->outros;
    }

    public function setOutros(string $outros): self
    {
        $this->outros = $outros;

        return $this;
    }

    public function getVaga(): ?VagaEmprego
    {
        return $this->vaga;
    }

    public function setVaga($vaga): self
    {
        $this->vaga = $vaga;

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

    public function getEstado(): ?int
    {
        return $this->estado;
    }

    public function setEstado(int $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
