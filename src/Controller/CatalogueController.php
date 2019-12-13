<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/catalogue", name="catalogue_")
 */
class CatalogueController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
        ]);
    }

    /**
     * @Route("/filter", name="filter")
     */
    public function filter()
    {
        return $this->render('catalogue/filter.html.twig', [
            'controller_name' => 'CatalogueController',
        ]);
    }
}
