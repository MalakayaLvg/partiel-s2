<?php

namespace App\Services;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Attribute\Route;

class CartService
{

    public function __construct(
        private FilmRepository $filmRepository,
        private RequestStack $requestStack
    )
    {

    }

    public function getCart()
    {
        $cart = $this->requestStack->getSession()->get("cart", []);
        $objectCart = [];
        foreach ($cart as $filmId => $quantity) {
            $item = [
                "film" => $this->filmRepository->find($filmId),
                "quantity" => $quantity

            ];
            $objectCart[] = $item;
        }

        return $objectCart;
    }

    public function addFilm(Film $film, int $quantity)
    {
        $cart = $this->requestStack->getSession()->get("cart", []);
        $filmId = $film->getId();

        if(isset($cart[$filmId])) {
            $cart[$filmId] = $cart[$filmId]+$quantity;
        }else  {
            $cart[$filmId] = $quantity;
        }

        $this->requestStack->getSession()->set("cart",$cart);

    }

     public function removeOneFilm(Film $film, int $quantity){
         $cart = $this->requestStack->getSession()->get("cart");
         $filmId = $film->getId();


         if(isset($cart[$filmId])) {

             $cart[$filmId] = $cart[$filmId]-$quantity;
             if($cart[$filmId] <= 0) {
                 unset($cart[$filmId]);
             }
         }

         $this->requestStack->getSession()->set("cart",$cart);

     }
     public function removeOneRow(Film $film){
        $cart = $this->requestStack->getSession()->get("cart");
        $filmId = $film->getId();

         if(isset($cart[$filmId])) {
             unset($cart[$filmId]);
         }



         $this->requestStack->getSession()->set("cart", $cart);

     }
     public function emptyCart()
     {
        $this->requestStack->getSession()->remove("cart");
     }
     public function getTotal()
     {
         $objectCart = $this->getCart();
         $total = 0;
         foreach ($objectCart as $item){
             $total += ($item["film"]->getPrice() * $item['quantity']);
         }

         return $total;
     }

     public function cartCount()
     {
         $cart = $this->requestStack->getSession()->get("cart",[]);
         $count = 0;

         foreach ($cart as $quantity){
             $count += $quantity;
         }

         return $count;
     }
}