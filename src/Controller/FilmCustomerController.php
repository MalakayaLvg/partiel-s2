<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FilmCustomerController extends AbstractController
{
    #[Route('/film/customer', name: 'app_film_customer')]
    public function index(FilmRepository $filmRepository): Response
    {
        return $this->render('film_customer/index.html.twig', [
            "films"=>$filmRepository->findAll()
        ]);
    }
}
