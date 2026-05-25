<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\UserManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserManager $userManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Utilisation du service SOLID
            $userManager->registerUser($user, $form->get('password')->getData());

            $this->addFlash('success', 'Votre compte a bien été créé ! Connectez-vous.');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();
        // Dernier nom d'utilisateur saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Cette méthode peut rester vide, Symfony intercepte la déconnexion automatiquement.
        throw new \LogicException('Cette méthode peut être vide, elle sera interceptée.');
    }
    #[Route('/profile', name: 'app_profile')]
    public function profile(): Response
    {
        // On récupère l'utilisateur connecté s'il existe
        $user = $this->getUser();

        return $this->render('security/profile.html.twig', [
            'user' => $user,
        ]);
    }
}