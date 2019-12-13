<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    /**
     * @Route("/", name="catalog")
     */
    public function index()
    {
        return $this->render('catalog/index.html.twig', [
            'catalog' => 'CatalogController',
        ]);
    }
}
