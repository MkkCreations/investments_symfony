<?php

namespace App\Entity;

use App\Repository\PortfolioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PortfolioRepository::class)]
class Portfolio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at;

    #[ORM\Column(length: 64)]
    private Status $status = Status::ACTIVE;

    #[ORM\OneToMany(targetEntity: Asset::class, mappedBy: 'portfolio', cascade: ['remove'])]
    private ?Collection $assets;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'portfolios')]
    private ?User $user = null;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
    }

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAssets(): ?Collection
    {
        return $this->assets;
    }

    public function setAssets(Collection $assets): static
    {
        $this->assets = $assets;

        return $this;
    }

    public function addAsset(Asset $asset): static
    {
        $this->assets->add($asset);
        $asset->setPortfolio($this);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
