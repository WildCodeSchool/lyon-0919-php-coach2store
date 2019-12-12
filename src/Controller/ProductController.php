<?php

namespace App\Controller;

use App\Service\Coach2StoreApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="product")
     * @param Coach2StoreApi $apiService
     * @return Response
     */
    public function index(Coach2StoreApi $apiService): Response
    {
        $productsByBrand = $apiService->getProductsByBrand('PRO');

        return $this->render('product/index.html.twig', [
            'productsByBrand' => $productsByBrand,
        ]);
    }
}
