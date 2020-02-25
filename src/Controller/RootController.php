<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RootController extends AbstractController
{
    /**
     * @Route("/", name="/")
     */
    public function index()
    {
        if (null === $this->getUser()) {
            return $this->redirect('login');
        }

        return $this->redirect('timeline');
    }
}
