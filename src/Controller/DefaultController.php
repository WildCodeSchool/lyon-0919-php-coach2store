<?php

namespace App\Controller;

use App\Form\SearchProductsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function header(Request $request)
    {
        $criteria = null;
        if ($searchParam = $request->query->get('search_products')) {
            $criteria = $searchParam['searchBar'];
        }
        $searchBar = $this->createForm(SearchProductsType::class, ['searchBar' => $criteria], [
            'method' => 'GET',
            'action' => $this->generateUrl('catalog_home'),
        ]);
        return $this->render('header.html.twig', [
            'searchBar' => $searchBar->createView(),
        ]);
    }
}