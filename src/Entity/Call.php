<?php

namespace App\Entity;

use App\Repository\CallRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CallRepository::class)]
class Call
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    
    #[ORM\Column(type: 'integer')]
    private int $vkId;
    
    #[ORM\Column(type: 'datetime')]
    private \DateTime $callDateTime;
    
    #[ORM\Column(type: 'string', length: '10')]
    private string $result;
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getVkId(): string
    {
        return $this->vkId;
    }

    public function setVkId(string $vkId): void
    {
        $this->vkId = $vkId;
    }

    public function getCallDateTime(): \DateTime
    {
        return $this->callDateTime;
    }

    public function setCallDateTime(\DateTime $callDateTime): void
    {
        $this->callDateTime = $callDateTime;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function setResult(string $result): void
    {
        $this->result = $result;
    }
}