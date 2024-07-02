<?php

namespace App\Controller;

use App\Entity\Language;
use App\Entity\Salle;
use App\Form\LanguageType;
use App\Form\SalleType;
use App\Repository\LanguageRepository;
use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/admin/salle')]
class SalleController extends AbstractController
{
    #[Route('/', name: 'app_salle')]
    public function index(SalleRepository $salleRepository): Response
    {
        return $this->render('salle/index.html.twig', [
            "salles"=>$salleRepository->findAll()
        ]);
    }

    #[Route('/create', name: 'app_salle_create')]
    public function create(Request $request, EntityManagerInterface $manager) : Response
    {
        $salle = new Salle();
        $form = $this->createForm(SalleType::class, $salle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($salle);
            $manager->flush();
            return $this->redirectToRoute('app_salle');
        }


        return $this->render('salle/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_salle_delete')]
    public function delete(Salle $salle, Request $request, EntityManagerInterface $manager): Response
    {
        $manager->remove($salle);
        $manager->flush();

        return $this->redirectToRoute('app_salle');
    }
}

