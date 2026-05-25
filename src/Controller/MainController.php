<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    // 1. Page d'accueil : Liste tous les produits
    #[Route('/', name: 'app_home')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('main/index.html.twig', [
            'produits' => $products,
        ]);
    }

    // 2. Page des détails d'un produit spécifique
    #[Route('/product/{id}', name: 'app_product_details')]
    public function productDetails(int $id, ProductRepository $productRepository): Response
    {
        $product = $productRepository->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Ce produit n\'existe pas en base de données.');
        }

        return $this->render('main/product_details.html.twig', [
            'produit' => $product,
        ]);
    }

    // 3. Page de navigation dans les catégories
    #[Route('/categories', name: 'app_browse_categories')]
    public function browseCategories(): Response
    {
        return $this->render('main/browse_categories.html.twig');
    }

    // 4. Page affichant les produits d'une catégorie spécifique
    #[Route('/category/products', name: 'app_products_by_category')]
    public function productsByCategory(): Response
    {
        return $this->render('main/products_by_category.html.twig');
    }
}
