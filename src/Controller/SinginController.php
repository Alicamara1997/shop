<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\SinginType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Routing\Annotation\Route;

class SinginController extends AbstractController
{
    #[Route('/singin', name: 'app_singin')]
    public function index(Request $req, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(SinginType::class, $user);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $plaintextPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();
            $this->addFlash('success', 'Inscription réussie ! Bienvenue sur notre plateforme.');
            return $this->redirectToRoute('index'); // Remplacez 'nom_de_votre_route' par le nom de votre route d'accueil
        }
        return $this->render('singin/index.html.twig', [
            'form' => $form,
        ]);
    }
}
