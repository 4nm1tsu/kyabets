<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Entity\Archive;
use App\Form\ArchiveType;

class ArchiveController extends AbstractController
{
    /**
     * @Route("/archive", name="archiveDisplay", methods={"GET"})
     */
    public function archiveDisplay()
    {
        $archives = $this->getDoctrine()->getManager()->getRepository(Archive::class)->findAll();
        /*
        echo($this->get('kernel')->getRootDir());
        //AbstractControllerでは下しか動かない
        echo($this->getParameter('kernel.project_dir').Archive::PATH);
         */

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

        return $this->render('archive/uploadForm.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/archive/upload", name="archiveUploadProcess", methods={"POST"})
     */
    public function archiveUploadProcess(Request $request)
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

        return $this->render('archive/uploadForm.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/archive/{id}", name="archiveShow", methods={"GET"})
     */
    public function archiveShow($id = null)
    {
        $archive = $this->getDoctrine()->getManager()->getRepository(Archive::class)->findOneBy(['id' => $id]);
        $file = $this->getParameter('kernel.project_dir').Archive::PATH.'/'.$archive->getArchiveName();

        return new BinaryFileResponse($file);
    }
}
