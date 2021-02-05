<?php

namespace App\Controller;

use Stripe\Stripe;
use Slim\Http\Request;
use Stripe\Checkout\Session;
use App\Service\Cart\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGenerator;
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
    public function success()
    {
        return $this->render('cart/success.html.twig');
    }

    /**
     * @Route("/error", name="error")
     */
    public function error()
    {
        return $this->render('cart/error.html.twig');
    }

    /**
     * @Route("create-checkout-session", name="checkout")
     */
    public function checkout()
    {
        \Stripe\Stripe::setApiKey('sk_test_51IHB1GA5Ie80voPhdRkjh2mF96KIQUKkE6f075k2SmdIXbgro6li1gY3iZFAOlljSua3RKyeR0D38EKIayijE7So00XhGsbYla');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                  'name' => 'Wine',
                ],
                'unit_amount' => 50000,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'cart/success.html.twig',
            'cancel_url' => 'cart/error.html.twig',
        ]);
        return new JsonResponse([ 'id' => $session->id ]);
    }
    
}

