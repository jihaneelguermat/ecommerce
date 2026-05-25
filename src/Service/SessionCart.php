<?php

namespace App\Service;

use App\Entity\CartItem;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionCart implements CartInterface
{
    private $session;

    // Symfony injecte RequestStack pour nous donner accès à la session
    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    public function add(CartItem $item): void
    {
        // On récupère le panier actuel en session ou un tableau vide
        $cart = $this->session->get('panier', []);

        $productId = $item->getProductId();

        // Si le produit est déjà dans le panier, on augmente la quantité
        if (isset($cart[$productId])) {
            $cart[$productId] += $item->getQuantity();
        } else {
            $cart[$productId] = $item->getQuantity();
        }

        // On sauvegarde le panier mis à jour en session
        $this->session->set('panier', $cart);
    }

    public function getCart(): array
    {
        return $this->session->get('panier', []);
    }
}
