<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index(CartService $cartservice): Response
    {
        return $this->render('cart/index.html.twig', [
            'items' => $cartservice->getFullCart(),
            'total' => $cartservice->getTotal()
        ]);
    }

    /**
     * @Route("cart/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartservice)
    {
       $cartservice->add($id);
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, CartService $cartservice) {
        
        $cartservice->remove($id);
        return $this->redirectToRoute('cart');
    }

}
