<?php

namespace App\Service;

use App\Entity\Person;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class MailSender
{
    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(Person $user)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('dev2020@gipe.com', 'Gipe2020'))
            ->to(new Address($user->getEmail ()))
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Thank you for your registration!')
            ->htmlTemplate('mailer/sendEMail.html.twig')
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'user' => $user,
            ])
        ;

        $this->mailer->send($email);
    }

    public function sendForgotPassword(Person $user)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('dev2020@gipe.com', 'Gipe2020'))
            ->to(new Address($user->getEmail ()))
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('You requested the reset of your password!')
            ->htmlTemplate('mailer/forgotPassword.html.twig')
            ->context([
                'user' => $user,
            ])
        ;

        $this->mailer->send($email);
    }
}