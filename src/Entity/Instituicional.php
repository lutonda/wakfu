<?php

namespace App\Entity;

use App\Repository\InstituicionalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstituicionalRepository::class)]
class Instituicional
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $mensagem;

    #[ORM\Column(type: 'text')]
    private $ensino;

    #[ORM\Column(type: 'text')]
    private $investigacao;

    #[ORM\Column(type: 'text')]
    private $extensao;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagemA;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagemB;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagemC;
    
    #[ORM\ManyToOne(targetEntity: 'Pessoa')]
    private $coordenador;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMensagem(): ?string
    {
        return $this->mensagem;
    }

    public function setMensagem(string $mensagem): self
    {
        $this->mensagem = $mensagem;

        return $this;
    }

    public function getEnsino(): ?string
    {
        return $this->ensino;
    }

    public function setEnsino(string $ensino): self
    {
        $this->ensino = $ensino;

        return $this;
    }

    public function getInvestigacao(): ?string
    {
        return $this->investigacao;
    }

    public function setInvestigacao(string $investigacao): self
    {
        $this->investigacao = $investigacao;

        return $this;
    }

    public function getExtensao(): ?string
    {
        return $this->extensao;
    }

    public function setExtensao(string $extensao): self
    {
        $this->extensao = $extensao;

        return $this;
    }

    public function getImagemA(): ?string
    {
        return $this->imagemA;
    }

    public function setImagemA(string $imagemA): self
    {
        $this->imagemA = $imagemA;

        return $this;
    }

    public function getImagemB(): ?string
    {
        return $this->imagemB;
    }

    public function setImagemB(string $imagemB): self
    {
        $this->imagemB = $imagemB;

        return $this;
    }

    public function getImagemC(): ?string
    {
        return $this->imagemC;
    }

    public function setImagemC(string $imagemC): self
    {
        $this->imagemC = $imagemC;

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
}
