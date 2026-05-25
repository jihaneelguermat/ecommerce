<?php

namespace App\Controller;

use App\Service\CartHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart/add/{id}', name: 'app_cart_add', methods: ['POST'])]
    public function add(int $id, Request $request, CartHandler $cartHandler): Response
    {
        $quantity = $request->request->getInt('quantity', 1);

        $cartHandler->handleAddItem($id, $quantity);

        $this->addFlash('success', 'Produit ajouté au panier !');

        return $this->redirectToRoute('app_home');
    }
}
