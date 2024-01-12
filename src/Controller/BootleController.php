<?php

namespace App\Controller;

use App\Entity\Bootle;
use App\Form\BottleType;
use App\Form\SearchBootleType;
use App\Repository\BootleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BootleController extends AbstractController
{
    #[Route('', name: 'app_bootle')]
    public function index(BootleRepository $bootleRepository, Request $request): Response
    {
        $form = $this->createForm(SearchBootleType::class,);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $bootles = $bootleRepository->findBy([
                'region' => $form->getData()['region']]);
        }
        else {
            $bootles = $bootleRepository->findAll();
        }
        return $this->render('bootle/index.html.twig', [
            'bootles' => $bootleRepository->findAll(),
            'bootles' => $bootles,
            'form'=> $form,
        ]);
    }

    #[Route('/new', name: 'app_bootle_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(BottleType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($form->getData());
            $em->flush();
            return $this->redirectToRoute('app_bootle');
        }
        return $this->render('bootle/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bottle_edit')]
    public function edit(Bootle $bootle, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(BottleType::class, $bootle);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            $em->flush();
            return $this->redirectToRoute('app_bootle');
        }
        return $this->render('bootle/edit.html.twig', [
            'bootle' => $bootle,
            'form' => $form
        ]);
    }

    #[Route('/{id}/delete', name: 'app_bottle_delete')]
    public function delete(Bootle $bootle,EntityManagerInterface $em): Response
    {
        $em->remove($bootle);
        $em->flush();
            return $this->redirectToRoute('app_bootle');
        
    }
}
