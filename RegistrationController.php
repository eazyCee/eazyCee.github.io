<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Person;
use App\Form\RegistrationFormType;
use App\Form\ResetFormType;
use App\Security\LoginFormAuthenticator;
use App\Repository\PersonRepository;
use App\Service\MailSender;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $authenticator
     * @return Response
     * @throws Exception
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, MailSender $mailer): Response
    {
        $user = new Person();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user ->setToken($random = random_int(1000000000,9999999999));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email
            $mailer->sendEmail($user);

            return $this->redirectToRoute('sentEmail');

             // return $guardHandler->authenticateUserAndHandleSuccess(
             //     $user,
             //     $request,
             //    $authenticator,
             //    'main' // firewall name in security.yaml
             // );
        }

         return $this->render('registration/register.html.twig', [
             'registrationForm' => $form->createView(),
         ]);
    }

    /**
     * @Route("/sentEmail", name="sentEmail")
     */
    public function emailConfirm()
    {   
        return $this->render('registration/emailSent.html.twig');

    }

    /**
    * @Route("/verify/{token}", methods={"GET","POST"})
    */
    public function verificationProcess(Person $person, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, Request $request )
    {  
        $em = $this->getDoctrine()->getManager();
            // $request->attributes->get('token')
       $person->setActive(true);
       $person->setActivatedAt(new DateTime());

                return $guardHandler->authenticateUserAndHandleSuccess(
                 $person,
                 $request,
                $authenticator,
                'main' // firewall name in security.yaml
              );
    }

    /**
    * @Route("/request_reset", name="reset_password", methods={"GET","POST"})
    */
    public function requestReset(Request $request, MailSender $mailer): Response
    {   
        $form = $this->createForm(ResetFormType::class);        
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid())
        {   
            $email = $form->get ('email')->getData();
             return $this->redirectToRoute('request_processed/', $email);
        }
        return $this->render('security/reset.html.twig', [
             'Reset' => $form->createView(),
         ]);
    }

    /**
    * @Route("/request_processed/{email}", name="reset_processed", methods={"GET","POST"})
    */
    public function requestProcessed(Request $request, MailSender $mailer, Person $person): Response
    {     
        $entityManager = $this->getDoctrine()->getManager();
        $mailer->sendForgotPassword($person);

        return $this->render('security/resetProcessed.html.twig', [
             'Reset' => $form->createView(),
         ]);
    }

     /**
    * @Route("/new_password/{token}", name="new_password", methods={"GET","POST"})
    */
    public function newPassword(Request $request, Person $person): Response
    {     
        $entityManager = $this->getDoctrine()->getManager();

        return $this->render('security/login.html.twig', [
             'Reset' => $form->createView(),
         ]);
    }
}
