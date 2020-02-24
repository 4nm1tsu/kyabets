<?php

namespace App\Controller;

use \DateTime;
use App\Entity\Bbs;
use App\Entity\Badge;
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
            if ($this->getUser() === null) {
                $this->addFlash('warning', 'Oh snap! Please log in. and try submitting again.');
            } else {
                $postDetail = new Bbs();
                $postDetail->setContents($request->request->get('contents'));
                $postDetail->setDate(new DateTime());
                $postDetail->setUser($this->getUser());
                $postDetail->setType(1);

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($postDetail);
                $manager->flush();

                return $this->redirect('/timeline');//二重投稿対策
            }
        }

        $repository = $this->getDoctrine()
                           ->getRepository(Bbs::class);
        $bbs = $repository->findby([], ['date' => 'DESC']);

        /*
        $badges = $this->getUser()->getBadges()->getValues();
        if (!in_array('admin', $badges)) {
            $badge = new Badge();
            $badge->setType('admin');
            $badge->setUser($this->getUser());
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($badge);
            $manager->flush();
        }
         */

        return $this->render('timeline/index.html.twig', [
            'controller_name' => 'TimelineController',
            'bbs' => $bbs,
            'user' => $this->getUser(),
            'debug' => $request->request->get('contents'),
        ]);
    }

    /**
     * @Route("/login_message", name="login_message")
     *
     * @return resource of the page to redirect to
     */
    public function loginMessage()
    {
        $this->addFlash('success', 'you\'ve successfully logged in!');

        return $this->redirectToRoute('timeline');
    }
}
