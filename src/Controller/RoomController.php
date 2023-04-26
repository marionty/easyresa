<?php

namespace App\Controller;


use App\Repository\RoomRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RoomController extends AbstractController
{
    #[Route('/room/{id}', name: 'app_room', methods: ['GET', 'POST'])]
    public function show($id, RoomRepository $oneRoom): Response
    {
        // Affiche la room demandée dans le template dédié
        return $this->render('room/index.html.twig', [
            // Récupère la room demandée par son id
            'oneRoom' => $oneRoom->findOneBy(
                ['id' => $id]
               

            ),
           

        ]);      
    }
} 
