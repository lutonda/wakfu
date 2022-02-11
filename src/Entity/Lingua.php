<?php

namespace App\Entity;

use App\Repository\LinguaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: LinguaRepository::class)]
class Lingua
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'uuid')]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nome;

    #[ORM\Column(type: 'string')]
    private $icon;
    
    #[ORM\Column(type: 'string')]
    private $code;

    #[ORM\Column(type: 'datetime', options:["default"=> "CURRENT_TIMESTAMP"])]
    protected $created;  

    #[ORM\Column(type:'boolean')]
    protected $isactive;  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }
}
