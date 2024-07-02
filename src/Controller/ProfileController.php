<?php

namespace App\Controller;


use App\Entity\PaymentMethod;
use App\Form\PaymentMethodType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {

        $newPaymentMethod = new PaymentMethod();
        $formPayment = $this->createForm(PaymentMethodType::class,$newPaymentMethod);

        return $this->render('profile/index.html.twig', [
            "formPayment" => $formPayment,

        ]);
    }

    #[Route('/profile/add/payment', name: 'app_profile_add_payment', methods: "POST" ,priority: 5,)]
    public function addPayment(Request $request, EntityManagerInterface $manager)
    {

        $newPayment = new PaymentMethod();
        $formPayment = $this->createForm(PaymentMethodType::class,$newPayment);
        $formPayment->handleRequest($request);
        if ($formPayment->isSubmitted() && $formPayment->isValid())
        {
            $newPayment->setOwner($this->getUser());
            $manager->persist($newPayment);
            $manager->flush();
        }

        return $this->redirectToRoute("app_profile");

    }

//    #[Route('/profile/order/history', name: "app_profile_order_history")]
//    public function orderHistory():Response
//    {
//        return $this->render("profile/orderHistory.html.twig",[
//
//        ]);
//    }

}
