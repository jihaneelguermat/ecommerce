<?php

namespace App\Entity;

class CartItem
{
    private int $productId;
    private int $quantity;

    public function __construct(int $productId, int $quantity = 1)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }
}