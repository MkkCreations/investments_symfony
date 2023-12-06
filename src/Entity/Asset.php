<?php

namespace App\Entity;

use App\Repository\AssetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssetRepository::class)]
class Asset
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $bought_at = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column]
    private ?int $bought_price = null;

    #[ORM\ManyToOne(targetEntity: Portfolio::class, inversedBy: 'assets')]
    private ?Portfolio $portfolio = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBoughtAt(): ?\DateTimeImmutable
    {
        return $this->bought_at;
    }

    public function setBoughtAt(\DateTimeImmutable $bought_at): static
    {
        $this->bought_at = $bought_at;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getBoughtPrice(): ?int
    {
        return $this->bought_price;
    }

    public function setBoughtPrice(int $bought_price): static
    {
        $this->bought_price = $bought_price;

        return $this;
    }
}
