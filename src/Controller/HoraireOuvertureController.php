<?php

namespace App\Controller;

use App\Entity\HoraireOuverture;
use App\Form\HoraireOuvertureType;
use App\Repository\HoraireOuvertureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/horairesouverture')]
class HoraireOuvertureController extends AbstractController
{
    #[Route('/', name: 'app_horaire_ouverture_index', methods: ['GET'])]
    public function index(HoraireOuvertureRepository $horaireOuvertureRepository): Response
    {
        return $this->render('horaire_ouverture/index.html.twig', [
            'horaire_ouvertures' => $horaireOuvertureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_horaire_ouverture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $horaireOuverture = new HoraireOuverture();
        $form = $this->createForm(HoraireOuvertureType::class, $horaireOuverture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($horaireOuverture);
            $entityManager->flush();

            return $this->redirectToRoute('app_horaire_ouverture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('horaire_ouverture/new.html.twig', [
            'horaire_ouverture' => $horaireOuverture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_horaire_ouverture_show', methods: ['GET'])]
    public function show(HoraireOuverture $horaireOuverture): Response
    {
        return $this->render('horaire_ouverture/show.html.twig', [
            'horaire_ouverture' => $horaireOuverture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_horaire_ouverture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HoraireOuverture $horaireOuverture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HoraireOuvertureType::class, $horaireOuverture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_horaire_ouverture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('horaire_ouverture/edit.html.twig', [
            'horaire_ouverture' => $horaireOuverture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_horaire_ouverture_delete', methods: ['POST'])]
    public function delete(Request $request, HoraireOuverture $horaireOuverture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$horaireOuverture->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($horaireOuverture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_horaire_ouverture_index', [], Response::HTTP_SEE_OTHER);
    }
}
