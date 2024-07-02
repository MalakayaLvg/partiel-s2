<?php

namespace App\Controller;

use App\Entity\Jour;
use App\Form\JourType;
use App\Repository\JourRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/jour')]
class JourController extends AbstractController
{
    #[Route('/', name: 'app_jour')]
    public function index(JourRepository $jourRepository): Response
    {
        return $this->render('jour/index.html.twig', [
            "jours"=>$jourRepository->findAll()
        ]);
    }

    #[Route('/create', name: 'app_jour_create')]
    public function create(Request $request, EntityManagerInterface $manager) : Response
    {
        $jour = new Jour();
        $form = $this->createForm(JourType::class, $jour);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($jour);
            $manager->flush();
            return $this->redirectToRoute('app_jour');
        }


        return $this->render('jour/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_jour_delete')]
    public function delete(Jour $jour, Request $request, EntityManagerInterface $manager): Response
    {
        $manager->remove($jour);
        $manager->flush();

        return $this->redirectToRoute('app_jour');
    }
}
