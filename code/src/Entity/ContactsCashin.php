<?php

namespace App\Entity;

use App\Repository\ContactsCashinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`t_contacts_cashin`')]
#[ORM\Entity(repositoryClass: ContactsCashinRepository::class)]
class ContactsCashin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\ManyToOne(inversedBy: 'contactsCashins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MobileMoneyOperator $operator = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getOperator(): ?MobileMoneyOperator
    {
        return $this->operator;
    }

    public function setOperator(?MobileMoneyOperator $operator): self
    {
        $this->operator = $operator;

        return $this;
    }
}
