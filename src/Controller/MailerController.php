<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

use Symfony\Component\Routing\Annotation\Route;
class MailerController extends AbstractController
{

    /**
     * @Route("email", name="mail_send")
     * @param MailerInterface $mailer
     * @throws TransportExceptionInterface
     */

    public function sendEmail(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('branimir@gmail.com')
            ->to('abcd@gmail.com')
            ->subject('Test')
            ->text('I sent new email');


        $mailer->send($email);
        return $this->redirectToRoute('home');
    }
}