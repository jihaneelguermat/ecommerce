<?php

namespace App\Service;

use App\Entity\CartItem;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CartHandler
{
    private CartInterface $cartStrategy;

    // Grâce à #[Autowire], on choisit la stratégie par défaut (SessionCart)
    public function __construct(
        #[Autowire(service: 'App\Service\SessionCart')] CartInterface $cartStrategy
    ) {
        $this->cartStrategy = $cartStrategy;
    }

    public function handleAddItem(int $productId, int $quantity): void
    {   
         $cartItem = new CartItem($productId, $quantity);
        
        // Exécution de la stratégie choisie
        $this->cartStrategy->add($cartItem);
    }

    public function getCartContent(): array
    {
        return $this->cartStrategy->getCart();
    }
}