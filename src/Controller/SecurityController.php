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
        if ($this->getUser() == null){
            $user = 'not logged in...';
        } else {
            $user = 'logged in:' . $this->getUser()->getUsername();
        }

        return $this->render('security/index.html.twig', [
            'error' => $error,
            'user' => $user,
        ]);
    }
}
