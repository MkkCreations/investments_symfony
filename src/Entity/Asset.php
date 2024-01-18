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
    private ?float $amount = null;

    #[ORM\Column]
    private ?float $bought_price = null;

    #[ORM\ManyToOne(targetEntity: Portfolio::class, inversedBy: 'assets', cascade: ['remove'])]
    private ?Portfolio $portfolio = null;

    #[ORM\Column(type: 'boolean')]
    private bool $active = true;

    #[ORM\Column(nullable: true)]
    private ?float $sold_price;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $sold_at;

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

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getBoughtPrice(): ?float
    {
        return $this->bought_price;
    }

    public function setBoughtPrice(float $bought_price): static
    {
        $this->bought_price = $bought_price;

        return $this;
    }

    public function getPortfolio(): ?Portfolio
    {
        return $this->portfolio;
    }

    public function setPortfolio(?Portfolio $portfolio): static
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getSoldPrice(): ?float
    {
        return $this->sold_price;
    }

    public function setSoldPrice(float $sold_price): static
    {
        $this->sold_price = $sold_price;

        return $this;
    }

    public function getSoldAt(): ?\DateTimeImmutable
    {
        return $this->sold_at;
    }

    public function setSoldAt(\DateTimeImmutable $sold_at): static
    {
        $this->sold_at = $sold_at;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
