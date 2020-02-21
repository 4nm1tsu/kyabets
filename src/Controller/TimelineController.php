<?php

namespace App\Controller;

use App\Entity\Bbs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * [GET] display all posts
 */
class TimelineController extends AbstractController
{
    /**
     * @Route("/timeline", name="timeline")
     *
     * @return resource of the page to redirect to
     */
    public function index(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $postDetail = new Bbs();
            //$postDetail->setContents($request->request->get('contents'));
            $postDetail->setContents("fuga");
            //$postDetail->setDate(date("Y-m-d H:i:s"));
            $postDetail->setDate(\DateTime::createFromFormat('Y-m-d', "2018-90-90"));
            $postDetail->setwrittenby(1);
            $postDetail->setType(1);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($postDetail);
            $manager->flush();

            return $this->redirect('/timeline');//二重投稿対策
        }
        $repository = $this->getDoctrine()
            ->getRepository(Bbs::class);
        $cards = $repository->findby([], ['date' => 'DESC']);

        return $this->render('timeline/index.html.twig', [
            'controller_name' => 'TimelineController',
            'cards' => $cards,
            'user' => $this->getUser(),
            'debug' => $request->getMethod(),
        ]);
    }
}
