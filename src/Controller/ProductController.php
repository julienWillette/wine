<?php

namespace App\Controller;

use App\Entity\Wine;
use App\Repository\WineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/produit", name="product")
     */
    public function index(WineRepository $wineReposytory): Response
    {
        return $this->render('product/index.html.twig', [
            'wine' => $wineReposytory->findAll(),
        ]);
    }

    /**
     * @Route("{id}", requirements={"id"="\d+"}, methods={"GET"}, name="" )
     */
    public function show(Wine $wine): Response
    {
        return $this->render('product/show.html.twig', [
            'wine' => $wine,
        ]);
    }
}
