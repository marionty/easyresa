<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Room;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation')]
    public function reserveRoomAction(Request $request, ManagerRegistry $doctrine, $id)
    {
        // Récupérer l'objet Room correspondant à l'id donné dans l'URL
        $room = $doctrine->getRepository(Room::class)->find($id);

        // Vérifier que la chambre existe
        if (!$room) {
            throw $this->createNotFoundException('The room does not exist');
        }

        // Créer une nouvelle réservation pour cette chambre
        $reservation = new Reservation();
        $reservation->setRoom($room);

        // Créer un formulaire pour la réservation
        $form = $this->createFormBuilder($reservation)
            ->add('startDate', DateTimeType::class, [
                'data' => new \DateTime('Europe/Paris'), // Valeur par défaut pour la date de début
            ])
            ->add('endDate', DateTimeType::class, [
                'data' => new \DateTime('Europe/Paris'), // Valeur par défaut pour la date de fin
            ])
            ->add('save', SubmitType::class, ['label' => 'Réserver'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer la réservation depuis le formulaire
            $reservation = $form->getData();

            // Ajouter la chambre à la réservation
            $reservation->setRoom($room);

            // Ajouter l'utilisateur authentifié à la réservation (remplacez par votre propre méthode si l'utilisateur n'est pas authentifié)
            $reservation->setUser($this->getUser());

            // Enregistrer la réservation en base de données
            $entityManager = $doctrine->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            // Afficher une page de confirmation de la réservation
            return $this->render('reservation/success.html.twig');
        }

        // Afficher le formulaire de réservation et les informations sur la chambre
        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView(),
            'room' => $room,
        ]);
    }
}