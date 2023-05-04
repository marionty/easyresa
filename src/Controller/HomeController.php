<?php
// Définition du namespace pour la classe HomeController
namespace App\Controller;

// Importation des classes nécessaires pour hériter d'AbstractController et utiliser les annotations de routage
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Définition de la classe HomeController qui hérite de AbstractController
class HomeController extends AbstractController
{
    // Définition d'une méthode publique nommée "index" qui renvoie un objet Response
    // La méthode est annotée avec l'URL '/' et le nom de route 'app_home'
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // Génère une réponse HTML en utilisant le template Twig 'home/index.html.twig'
        // Le nom de la classe HomeController est passé au template comme une variable 'controller_name'
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}