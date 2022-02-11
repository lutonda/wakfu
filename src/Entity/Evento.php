<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[ORM\Column(type: 'text')]
    private $texto;

    #[ORM\Column(type: 'datetime')]
    private $data;

    #[ORM\Column(type: 'text')]
    private $imagem;

    #[ORM\Column(type: 'string')]
    private $code;
    
    #[ORM\Column(type: 'datetime', options:["default"=> "CURRENT_TIMESTAMP"])]
    protected $created;  

    #[ORM\Column(type:'boolean')]
    protected $isactive;  

    #[ORM\ManyToMany(targetEntity: 'Tag')]
    private $tags;

    public function __construct()
    {
        $this->created=new   \DateTime();
    }
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

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }
}
