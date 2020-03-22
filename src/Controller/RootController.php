<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RootController extends AbstractController
{
    /**
     * @Route("/", name="rootRedirect")
     */
    public function rootRedirect()
    {
        if (null === $this->getUser()) {
            return $this->redirectToRoute('login');
        }

        return $this->redirectToRoute('timelineDisplay');
    }
}
