<?php

namespace App\Entity;

use App\Repository\OperationStatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`t_operation_status`')]
#[ORM\Entity(repositoryClass: OperationStatusRepository::class)]
class OperationStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lib = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLib(): ?string
    {
        return $this->lib;
    }

    public function setLib(string $lib): self
    {
        $this->lib = $lib;

        return $this;
    }
}
