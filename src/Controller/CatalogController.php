<?php

namespace App\Controller;

use App\Service\Coach2StoreApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/catalog", name="catalog_")
 */
class CatalogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param Coach2StoreApi $apiService
     * @return Response
     */
    public function index(Coach2StoreApi $apiService): Response
    {
        $productsByBrand = $apiService->getProductsByBrand('vélo');
        $productsBySupplier = $apiService->getProductsBySupplier('tennis');
        $productsTop = $apiService->getProductsTop();

        return $this->render('catalog/index.html.twig', [
            'productsByBrand' => $productsByBrand,
            'productsBySupplier' => $productsBySupplier,
            'productsTop' => $productsTop,
        ]);
    }
}
