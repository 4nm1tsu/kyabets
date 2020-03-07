<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/email", name="email")
     */
    public function sendEmail(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('hibiki.128627.mell@gmail.com')
            ->to('4617016@ed.tus.ac.jp')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('<<Kyabets>> Please login from here!')
            ->text('')
            ->html('<a href="http://localhost:8000/login">here</a>');

        $mailer->send($email);

        return $this->redirectToRoute('timeline');
    }
}
