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
    public function index(WineRepository $wineRepository, Request $request): Response
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        [$min, $max] = $wineRepository->findMinMax($data);
        $wineRepository = $wineRepository->findSearch($data);
        return $this->render('product/index.html.twig', [
            'wine' => $wineRepository,
            'form' => $form->createView(),
            'min' => $min,
            'max' => $max
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
