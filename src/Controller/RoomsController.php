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
 
    #[Route('/rooms', name: 'app_rooms')]
    public function roomfiltertype(RoomRepository $roomRepository, Request $request): Response
    {
        $form = $this->createForm(RoomFilterType::class);
        $form->handleRequest($request);

        $rooms = $roomRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $rooms = $roomRepository->findRoomBySearch($data);
        }

        return $this->render('rooms/index.html.twig', [
            'rooms' => $rooms,
            'form' => $form->createView(),
        ]);
    }
}