<?php

namespace App\Entity;

use App\Repository\PeriodoRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: PeriodoRepository::class)]
class Periodo
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nome;

    #[ORM\Column(type: 'string')]
    private $code;

    #[ORM\Column(type: 'datetime', options:["default"=> "CURRENT_TIMESTAMP"])]
    protected $created;  

    #[ORM\Column(type:'boolean')]
    protected $isactive=true;  

    public function __construct()
    {
        $this->created=new   \DateTime();
    }
    public function getId()
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

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code): self
    {
        $this->code = $code;

        return $this;
    }
    public function isIsactive(): ?bool
    {
        return $this->isactive;
    }

    public function setIsactive(int $isactive): self
    {
        $this->isactive = $isactive;

        return $this;
    }
    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated(int $created): self
    {
        $this->created = $created;

        return $this;
    }
}
