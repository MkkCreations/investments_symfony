<?php

namespace App\Entity;

use App\Repository\BalanceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BalanceRepository::class)]
class Balance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\JoinColumn(nullable: true)]
    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'balance', cascade: ['persist', 'remove'])]
    private User $user;

    #[ORM\Column]
    private int $amount = 0;

    #[ORM\Column]
    private string $currency;

    public function __construct()
    {
        $this->currency = Currency::EUR->value;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrency(): string
    {
        $currency = $this->getCurrency();
        if ($currency === null) {
            $currency = Currency::EUR->value;
        }

        return $this->currency;
    }

    public function setCurrency(Currency $currency): static
    {
        $this->currency = $currency->value;

        return $this;
    }
}
