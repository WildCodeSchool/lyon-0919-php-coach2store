<?php

namespace App\Controller;

use App\Form\FilterProductsType;
use App\Form\SearchProductsType;
use App\Service\Coach2StoreApi;
use Exception;
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
        $criteria = null;
        if ($searchParam = $request->query->get('search_products')) {
            $criteria = $searchParam['searchBar'];
        }
        $searchBar = $this->createForm(SearchProductsType::class, ['searchBar' => $criteria], [
            'method' => 'GET',
            'action' => $this->generateUrl('catalog_home'),
        ]);
        $searchBar->handleRequest($request);
        $brands = [];
        $suppliers = [];
        $products = $apiService->getProductsTop();

        if ($searchBar->isSubmitted() && $searchBar->isValid()) {
            $data = $searchBar->getData();
            $criteria = $data['searchBar'];
        }

        if ($criteria) {
            $result = $apiService->getProductsByCriteria($criteria);

            $products = $result['hits']['hit'];
            $products = array_map('App\Service\Coach2StoreApi::simplifyProduct', $products);

            $brands = $result['facets']['brand']['buckets'];
            $brands = array_map('App\Service\Coach2StoreApi::simplifyBrand', $brands);

            $suppliers = $result['facets']['supplier_name']['buckets'];
            $suppliers = array_map('App\Service\Coach2StoreApi::simplifySupplier', $suppliers);
        }

        $filter = $this->createForm(FilterProductsType::class, null, [
            'method' => 'POST',
            'brands' => $brands,
            'suppliers' => $suppliers,
        ]);

        $filter->handleRequest($request);

        if ($filter->isSubmitted() && $filter->isValid()) {
            $data = $filter->getData();
            $selectBrands = $data['brands'];
            $selectSuppliers = $data['suppliers'];
            $result = $apiService->getProductsByCriteria($criteria, $selectBrands, $selectSuppliers);
            $products = $result['hits']['hit'];
            $products = array_map('App\Service\Coach2StoreApi::simplifyProduct', $products);
        }

        return $this->render('catalog/index.html.twig', [
            'productsTop' => $products,
            'searchBar' => $searchBar->createView(),
            'filter' => $filter->createView(),
        ]);
    }

    /**
     * @Route("/product/{id}", name="product_show")
     * @param Coach2StoreApi $apiService
     * @param string $id
     * @return Response
     * @throws Exception
     */
    public function show(Coach2StoreApi $apiService, string $id)
    {
        $result = $apiService->getProductsByCriteria($id);

        if (isset($result['hits']['hit'])) {
            $product = $result['hits']['hit'][0]['fields'];
        } else {
            throw new Exception("Produit introuvable", 404);
        }
        return $this->render('catalog/show.html.twig', [
            'product' => $product,
        ]);
    }
}
