<?php

namespace App\Controller;

use App\Form\RoomFilterType;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomsController extends AbstractController
{
 // Définit la route "/rooms" avec le nom "app_rooms"
    #[Route('/rooms', name: 'app_rooms')]
    public function roomfiltertype(RoomRepository $roomRepository, Request $request): Response
    {
        // Crée un formulaire RoomFilterType
        $form = $this->createForm(RoomFilterType::class);
        // Traite la requête HTTP
        $form->handleRequest($request);
        // Récupère toutes les chambres
        $rooms = $roomRepository->findAll();

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupère les données soumises du formulaire
            $data = $form->getData();
            // Recherche des chambres en fonction des critères de recherche
            $rooms = $roomRepository->findRoomBySearch($data);
        }
        // Renvoie la vue "rooms/index.html.twig" avec les chambres et le formulaire
        return $this->render('rooms/index.html.twig', [
            'rooms' => $rooms,
            'form' => $form->createView(),
        ]);
    }
}