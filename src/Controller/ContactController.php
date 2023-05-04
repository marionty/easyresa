<?php

// Définition du namespace pour la classe ContactController
namespace App\Controller;

// Importation des classes nécessaires pour hériter d'AbstractController et utiliser les annotations de routage
use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use PharIo\Manifest\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

// Définition de la classe ContactController qui hérite de AbstractController
class ContactController extends AbstractController
{
    // Définition d'une méthode publique nommée "index" qui renvoie un objet Response
    // La méthode est annotée avec l'URL '/contact' et le nom de route 'app_contact'
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        // Création d'un nouvel objet Contact
        $contact = new Contact();

        // Création d'un formulaire basé sur la classe ContactType
        $form = $this->createForm(ContactType::class, $contact);

        // Traitement du formulaire si le formulaire a été soumis et est valide
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Persiste l'objet Contact en utilisant l'EntityManager
            $entityManager->persist($contact);
            $entityManager->flush();

            // Envoyer un message flash pour indiquer que le message a été envoyé avec succès
            $this->addFlash('success', 'your message has been sent');
        }

        // Génère une réponse HTML en utilisant le template Twig 'contact/index.html.twig'
        // Le formulaire créé est passé au template comme une variable 'form'
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}