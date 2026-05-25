<?php

namespace App\Service;
use App\Service\CartInterface;
use App\Entity\CartItem;

interface CartInterface
{
    public function add(CartItem $item): void;
    public function getCart(): array;
}
