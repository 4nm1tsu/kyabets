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
     * @Route("/archive", name="archiveDisplay", methods={"GET"})
     */
    public function archiveDisplay(Request $request)
    {
        $archives = $this->getDoctrine()->getManager()->getRepository(Archive::class)->findAll();

        return $this->render('archive/displayArchive.html.twig', [
            'archives' => $archives,
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/archive/upload", name="archiveUploadForm", methods={"GET"})
     */
    public function archiveUploadForm(Request $request)
    {
        $archive = new Archive();
        $form = $this->createForm(ArchiveType::class, $archive);

        $form->handleRequest($request);
        return $this->render('archive/uploadForm.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/archive/upload", name="archiveUploadProcess", methods={"POST"})
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

            return $this->redirectToRoute('archiveDisplay');
        }

        return $this->redirectToRoute('archiveDisplay');
    }

}
