<?php
// Importer le repository RoomRepository et les classes Symfony nécessaires
namespace App\Controller;

use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Définir la classe RoomController qui hérite d'AbstractController
class RoomController extends AbstractController
{
    // Définir une route qui affichera une "room" en utilisant l'id spécifié
    #[Route('/room/{id}', name: 'app_room', methods: ['GET', 'POST'])]
    public function show($id, RoomRepository $oneRoom): Response
    {
        // Récupérer la "room" spécifiée par son id à partir du repository
        $room = $oneRoom->findOneBy(['id' => $id]);

        // Afficher la "room" demandée dans le template dédié
        return $this->render('room/index.html.twig', [
            'oneRoom' => $room, // Passer la "room" récupérée au template
        ]);      
    }
} 