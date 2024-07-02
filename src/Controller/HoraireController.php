<?php

namespace App\Controller;

use App\Entity\Horaire;
use App\Entity\Salle;
use App\Form\HoraireType;
use App\Form\SalleType;
use App\Repository\HoraireRepository;
use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/horaire')]
class HoraireController extends AbstractController
{
    #[Route('/', name: 'app_horaire')]
    public function index(HoraireRepository $horaireRepository): Response
    {
        return $this->render('horaire/index.html.twig', [
            "horaires"=>$horaireRepository->findAll()
        ]);
    }

    #[Route('/create', name: 'app_horaire_create')]
    public function create(Request $request, EntityManagerInterface $manager) : Response
    {
        $horaire = new Horaire();
        $form = $this->createForm(HoraireType::class, $horaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($horaire);
            $manager->flush();
            return $this->redirectToRoute('app_horaire');
        }


        return $this->render('horaire/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_horaire_delete')]
    public function delete(Horaire $horaire, Request $request, EntityManagerInterface $manager): Response
    {
        $manager->remove($horaire);
        $manager->flush();

        return $this->redirectToRoute('app_horaire');
    }
}
