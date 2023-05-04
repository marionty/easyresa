<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance de l'entité User
        $user = new User();

        // Création d'un formulaire d'inscription avec le formulaire RegistrationFormType et la nouvelle instance de l'entité User
        $form = $this->createForm(RegistrationFormType::class, $user);

        // Traitement de la requête HTTP (soumission du formulaire)
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // Encodage du mot de passe en clair avec l'algorithme de hachage spécifié par UserPasswordHasherInterface
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData() // Récupération du mot de passe en clair depuis le formulaire
                )
            );

            // Persistance de l'entité User dans la base de données via l'EntityManager
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirection de l'utilisateur vers la page d'accueil
            return $this->redirectToRoute('app_home');
        }

        // Rendu du template d'inscription 'registration/register.html.twig' avec le formulaire créé précédemment
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}