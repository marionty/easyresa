<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\RoomRepository;

class RoomsController extends AbstractController
{
    #[Route('/rooms', name: 'app_rooms')]
    public function index(RoomRepository $room): Response
    {
        $liste = $room->findAll();

        return $this->render('rooms/index.html.twig', [
            'liste_twig' => $liste,
        ]);
    }
}
