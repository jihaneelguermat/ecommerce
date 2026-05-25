<?php

namespace App\Service;

use App\Entity\CartItem;

class ApiCart implements CartInterface
{
    public function add(CartItem $item): void
    {
        // Le dd() demandé par le prof pour simuler et tester l'API
        dd("SOLID validé ! L'article " . $item->getProductId() . " a été envoyé via l'API externe fictive.");
    }

    public function getCart(): array
    {
        return [];
    }
}
