<?php

namespace App\Controller;

use App\Service\Coach2StoreApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/brand", name="product_brand")
     * @param Coach2StoreApi $apiService
     * @return Response
     */
    public function showBrand(Coach2StoreApi $apiService): Response
    {
        $productsByBrand = $apiService->getProductsByBrand('vélo');

        return $this->render('product/brand.html.twig', [
            'productsByBrand' => $productsByBrand,
        ]);
    }

    /**
     * @Route("/product/supplier", name="product_supplier")
     * @param Coach2StoreApi $apiService
     * @return Response
     */
    public function showSupplier(Coach2StoreApi $apiService): Response
    {
        $productsBySupplier = $apiService->getProductsBySupplier('tennis');

        return $this->render('product/supplier.html.twig', [
            'productsBySupplier' => $productsBySupplier,
        ]);
    }
}
