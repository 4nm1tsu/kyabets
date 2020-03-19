<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Archive;
use App\Form\ArchiveType;

class ArchiveController extends AbstractController
{
    /**
     * @Route("/archive", name="archive", methods={"GET"})
     */
    public function index(Request $request)
    {
        $archive = new Archive();
        $form = $this->createForm(ArchiveType::class, $archive);

        $form->handleRequest($request);
        return $this->render('archive/index.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/archive", name="archive_upload", methods={"POST"})
     */
    public function upload(Request $request)
    {
        $archive = new Archive();
        $form = $this->createForm(ArchiveType::class, $archive);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($archive);
            $em->flush();

            return $this->redirectToRoute('archive');
        }

        return $this->redirectToRoute('archive');
    }

}
