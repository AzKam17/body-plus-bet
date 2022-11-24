<?php

namespace App\Entity;

use App\Repository\MobileMoneyOperatorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`t_mobile_money_operator`')]
#[ORM\Entity(repositoryClass: MobileMoneyOperatorRepository::class)]
class MobileMoneyOperator
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\OneToMany(mappedBy: 'operator', targetEntity: Operation::class)]
    private Collection $operations;

    #[ORM\OneToMany(mappedBy: 'operator', targetEntity: ContactsCashin::class)]
    private Collection $contactsCashins;

    public function __construct()
    {
        $this->operations = new ArrayCollection();
        $this->contactsCashins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, Operation>
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations->add($operation);
            $operation->setOperator($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getOperator() === $this) {
                $operation->setOperator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ContactsCashin>
     */
    public function getContactsCashins(): Collection
    {
        return $this->contactsCashins;
    }

    public function addContactsCashin(ContactsCashin $contactsCashin): self
    {
        if (!$this->contactsCashins->contains($contactsCashin)) {
            $this->contactsCashins->add($contactsCashin);
            $contactsCashin->setOperator($this);
        }

        return $this;
    }

    public function removeContactsCashin(ContactsCashin $contactsCashin): self
    {
        if ($this->contactsCashins->removeElement($contactsCashin)) {
            // set the owning side to null (unless already changed)
            if ($contactsCashin->getOperator() === $this) {
                $contactsCashin->setOperator(null);
            }
        }

        return $this;
    }
}
