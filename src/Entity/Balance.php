<?php

namespace App\Entity;

use App\Repository\BalanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private Currency $currency;

    #[ORM\OneToMany(mappedBy: 'balance', targetEntity: LogBalance::class, orphanRemoval: true)]
    private Collection $logBalances;

    public function __construct()
    {
        $this->currency = Currency::EUR;
        $this->addedAt = new \DateTimeImmutable();
        $this->logBalances = new ArrayCollection();
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

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return Collection<int, LogBalance>
     */
    public function getLogBalances(): Collection
    {
        return $this->logBalances;
    }

    public function addLogBalance(LogBalance $logBalance): static
    {
        if (!$this->logBalances->contains($logBalance)) {
            $this->logBalances->add($logBalance);
            $logBalance->setBalance($this);
        }

        return $this;
    }

    public function removeLogBalance(LogBalance $logBalance): static
    {
        if ($this->logBalances->removeElement($logBalance)) {
            // set the owning side to null (unless already changed)
            if ($logBalance->getBalance() === $this) {
                $logBalance->setBalance(null);
            }
        }

        return $this;
    }
}
