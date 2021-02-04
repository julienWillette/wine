<?php

namespace App\Controller;

use App\Entity\Wine;
use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\WineRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/produit", name="product")
     */
    public function index(WineRepository $wineReposytory, Request $request): Response
    {
        $data = new SearchData();
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        $wineReposytory = $wineReposytory->findSearch($data);
        return $this->render('product/index.html.twig', [
            'wine' => $wineReposytory,
            'form' => $form->createView()
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
