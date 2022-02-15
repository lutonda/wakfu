<?php

namespace App\Entity;

use App\Repository\SobreRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: SobreRepository::class)]
class Sobre
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'text')]
    private $sobre;

    #[ORM\Column(type: 'text')]
    private $missao;

    #[ORM\Column(type: 'text')]
    private $visao;

    #[ORM\Column(type: 'text')]
    private $historia;

    #[ORM\Column(type: 'text')]
    private $mensagem='x';


    public function getId()
    {
        return $this->id;
    }

    public function getSobre(): ?string
    {
        return $this->sobre;
    }

    public function setSobre(string $sobre): self
    {
        $this->sobre = $sobre;

        return $this;
    }

    public function getMissao(): ?string
    {
        return $this->missao;
    }

    public function setMissao(string $missao): self
    {
        $this->missao = $missao;

        return $this;
    }

    public function getVisao(): ?string
    {
        return $this->visao;
    }

    public function setVisao(string $visao): self
    {
        $this->visao = $visao;

        return $this;
    }

    public function getHistoria(): ?string
    {
        return $this->historia;
    }

    public function setHistoria(string $historia): self
    {
        $this->historia = $historia;

        return $this;
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
}
