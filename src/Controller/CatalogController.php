<?php

namespace App\Controller;

use App\Form\SearchProductsType;
use App\Service\Coach2StoreApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return Response
     */
    public function index(Coach2StoreApi $apiService, Request $request): Response
    {
        $brands = [];
        $suppliers = [];
        $products = $apiService->getProductsTop();
        $form = $this->createForm(SearchProductsType::class, null, [
            'method' => 'GET',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $criteria = $data['search'];
            $result = $apiService->getProductsByCriteria($criteria);
            $products = $result['hits']['hit'];
            $products = array_map('App\Service\Coach2StoreApi::simplify', $products);
            $brands = $result['facets']['brand']['buckets'];
            $suppliers = $result['facets']['supplier_name']['buckets'];
        }

        return $this->render('catalog/index.html.twig', [
            'brands' => $brands,
            'suppliers' => $suppliers,
            'productsTop' => $products,
            'form' => $form->createView(),
        ]);
    }
}
