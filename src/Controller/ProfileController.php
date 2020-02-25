<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function index($id = null)
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'profileController',
            'user' => $this->getUser(),
        ]);
    }
}
