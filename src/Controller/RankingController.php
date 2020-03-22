<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RankingController extends AbstractController
{
    /**
     * @Route("/ranking", name="ranking")
     */
    public function ranking()
    {
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $users = $repository->findby([], ['contribution' => 'DESC']);

        return $this->render('ranking/index.html.twig', [
            'controller_name' => 'RankingController',
            'user' => $this->getUser(),
            'users' => $users,
        ]);
    }
}
