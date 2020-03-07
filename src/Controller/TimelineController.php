<?php

namespace App\Controller;

use \DateTime;
use App\Entity\Bbs;
use App\Entity\Badge;
use App\Entity\Reply;
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

        /*バッジを付け替える処理
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
            'bbs' => $bbs,
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/timeline/{id}", name="timelineDetail")
     *
     * @return resource of the page to redirect to
     */
    public function detail($id = null, Request $request)
    {
        if ($request->getMethod() === 'POST') {
            if ($this->getUser() === null) {
                $this->addFlash('warning', 'Oh snap! Please log in. and try submitting again.');
            } else {
                $repository = $this->getDoctrine()
                                   ->getRepository(Bbs::class);
                $bbs = $repository->findOneBy(['id' => $id]);

                $replyDetail = new Reply();
                $replyDetail->setContents($request->request->get('contents'));
                $replyDetail->setDate(new DateTime());
                $replyDetail->setBbs($bbs);
                $replyDetail->setUser($this->getUser());

                $manager = $this->getDoctrine()->getManager();
                $manager->persist($replyDetail);
                $manager->flush();

                return $this->redirect("/timeline/$id");
            }
        }

        $replies = null;
        $repository = $this->getDoctrine()
                           ->getRepository(Bbs::class);
        $bbs = $repository->findOneBy(['id' => $id]);
        if (null === $bbs) {
            $this->redirectToRoute('timeline');
        } else {
            $replies = $bbs->getReplies();
        }

        return $this->render('timeline/detail.html.twig', [
            'bbs' => $bbs,
            'user' => $this->getUser(),
            'replies' => $replies,
        ]);
    }

    /**
     * @Route("/login_message", name="loginMessage")
     *
     * @return resource of the page to redirect to
     */
    public function loginMessage()
    {
        $this->addFlash('success', 'you\'ve successfully logged in!');

        return $this->redirectToRoute('timeline');
    }
}
