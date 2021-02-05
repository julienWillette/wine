<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Service\Cart\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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


    /**
     * @Route("/success", name="success")
     */
    public function success(Request $request, SessionInterface $session): Response
    {
        $this->addFlash(
            'notice',
            'Votre commande a bien été pris en compte'
        );
        $session->clear();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/error", name="error")
     */
    public function error()
    {
        return $this->render('cart/error.html.twig');
    }
    
}

