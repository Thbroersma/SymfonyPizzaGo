<?php

namespace App\Entity;

use App\Repository\SizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizeRepository::class)]
class Size
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'size', targetEntity: Order::class)]
    private $orders;



    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->orderSize = new ArrayCollection();
        $this->orderNumber = new ArrayCollection();
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

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setSize($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getSize() === $this) {
                $order->setSize(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderSize(): Collection
    {
        return $this->orderSize;
    }

    public function addOrderSize(Order $orderSize): self
    {
        if (!$this->orderSize->contains($orderSize)) {
            $this->orderSize[] = $orderSize;
            $orderSize->setSizeId($this);
        }

        return $this;
    }

    public function removeOrderSize(Order $orderSize): self
    {
        if ($this->orderSize->removeElement($orderSize)) {
            // set the owning side to null (unless already changed)
            if ($orderSize->getSizeId() === $this) {
                $orderSize->setSizeId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrderNumber(): Collection
    {
        return $this->orderNumber;
    }

    public function addOrderNumber(Order $orderNumber): self
    {
        if (!$this->orderNumber->contains($orderNumber)) {
            $this->orderNumber[] = $orderNumber;
            $orderNumber->setSize($this);
        }

        return $this;
    }

    public function removeOrderNumber(Order $orderNumber): self
    {
        if ($this->orderNumber->removeElement($orderNumber)) {
            // set the owning side to null (unless already changed)
            if ($orderNumber->getSize() === $this) {
                $orderNumber->setSize(null);
            }
        }

        return $this;
    }
}
