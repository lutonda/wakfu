<?php

namespace App\Entity;

use App\Repository\SubscribeRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;

#[ORM\Entity(repositoryClass: SubscribeRepository::class)]
class Subscribe
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid')]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Assert\Uuid]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $fullName;

    #[ORM\Column(type: 'string', unique:true, length: 255)]
    private $email;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $telephone;

    #[ORM\Column(type: 'boolean')]
    private $active=true;

    #[ORM\Column(type: 'datetime', nullable: true, options:["default"=> "CURRENT_TIMESTAMP"])]
    protected $created; 
    
    public function __construct()
    {
        $this->created=new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(?string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
    
    public function getCreated():DateTime
    {
        return $this->created;
    }
    public function setcreated($created): self
    {
        $this->created = $created;

        return $this;
    }
}
