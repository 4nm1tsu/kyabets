<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function index(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        if ($this->getUser() === null) {
            return $this->render(
                'security/index.html.twig',
                [
                    'error' => $error,
                    'user' => $this->getUser(),
                ]
            );
        }

        return $this->redirectToRoute('timelineDisplay');
    }

    /**
     * @Route("/logout_message", name="logoutMessage")
     *
     * @return resource of the page to redirect to
     */
    public function logoutMessage()
    {
        $this->addFlash('success', 'you\'ve successfully logged out!');

        return $this->redirectToRoute('login');
    }
}
