<?php

namespace App\Entity;

use App\Repository\DepartamentoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DepartamentoRepository::class)]
class Departamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid')]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[ORM\ManyToMany(targetEntity: 'Pessoa')]
    private $pessoas;

    #[ORM\Column(type: 'string')]
    private $code;

    #[ORM\Column(type: 'text')]
    private $imagem;
    
    #[ORM\Column(type: 'string')]
    private $icon;
    
    #[ORM\Column(type: 'datetime', options:["default"=> "CURRENT_TIMESTAMP"])]
    protected $created;  

    #[ORM\Column(type:'boolean')]
    protected $isactive;  

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

    public function getPessoas(): ?int
    {
        return $this->pessoas;
    }

    public function setPessoas(int $pessoas): self
    {
        $this->pessoas = $pessoas;

        return $this;
    }
}
