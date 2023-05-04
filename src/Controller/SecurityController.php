<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    // Définit la route "/login" avec le nom "app_login"
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Vérifie si l'utilisateur est déjà authentifié, si oui, le redirige vers la page "target_path"
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // Récupère l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // Récupère le dernier nom d'utilisateur entré par l'utilisateur
        $lastUsername = $authenticationUtils->getLastUsername();

        // Renvoie la vue "security/login.html.twig" avec le dernier nom d'utilisateur et l'erreur de connexion
        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    // Définit la route "/logout" avec le nom "app_logout"
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Génère une exception si cette méthode est appelée directement, car elle sera interceptée par la clé de déconnexion de votre pare-feu
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}