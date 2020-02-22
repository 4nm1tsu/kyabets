<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArchiveController extends AbstractController
{
    /**
     * @Route("/archive", name="archive")
     */
    public function index()
    {
        return $this->render('archive/index.html.twig', [
            'controller_name' => 'ArchiveController',
            'user' => $this->getUser(),
        ]);
    }
}
