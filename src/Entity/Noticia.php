<?php

namespace App\Entity;

use App\Repository\NoticiaRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: NoticiaRepository::class)]
class Noticia
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titulo;

    #[ORM\Column(type: 'string', length: 255)]
    private $categoria='x';

    #[ORM\Column(type: 'text')]
    private $text;

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
        $this->code=Uuid::uuid4();
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

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
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

    public function isIsactive()
    {
        return $this->isactive;
    }

    public function setIsactive($isactive): self
    {
        $this->isactive = $isactive;

        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created): self
    {
        $this->created = $created;

        return $this;
    }
}
