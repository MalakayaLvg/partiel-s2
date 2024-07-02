<?php

namespace App\Controller;

use App\Entity\Film;
use App\Entity\Language;
use App\Form\FilmType;
use App\Form\LanguageType;
use App\Repository\LanguageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/language')]
class LanguageController extends AbstractController
{
    #[Route('/', name: 'app_language')]
    public function index(LanguageRepository $languageRepository): Response
    {
        return $this->render('language/index.html.twig', [
            "languages"=>$languageRepository->findAll()
        ]);
    }

    #[Route('/create', name: 'app_language_create')]
    public function create(Request $request, EntityManagerInterface $manager) : Response
    {
        $language = new Language();
        $form = $this->createForm(LanguageType::class, $language);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($language);
            $manager->flush();
            return $this->redirectToRoute('app_language');
        }


        return $this->render('language/create.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete/{id}', name: 'app_language_delete')]
    public function delete(Language $language, Request $request, EntityManagerInterface $manager): Response
    {
        $manager->remove($language);
        $manager->flush();

        return $this->redirectToRoute('app_language');
    }
}
