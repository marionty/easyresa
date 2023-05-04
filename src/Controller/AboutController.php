<?php
// Définition du namespace pour la classe AboutController
namespace App\Controller;
// Importation des classes nécessaires pour hériter d'AbstractController et utiliser les annotations de routage
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// Définition de la classe AboutController qui hérite de AbstractController
class AboutController extends AbstractController
{   
    // Définition d'une méthode publique nommée "index" qui renvoie un objet Response
    // La méthode est annotée avec l'URL '/about' et le nom de route 'app_about'
    #[Route('/about', name: 'app_about')]
    public function index(): Response
    {
        // Utilisation de la méthode render de AbstractController pour générer une réponse HTML avec un template Twig
        // Le template 'about/index.html.twig' est utilisé avec une variable 'controller_name' qui a la valeur 'AboutController'
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }
}
