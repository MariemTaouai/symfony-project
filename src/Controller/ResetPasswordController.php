<?php

namespace App\Controller;

use App\Entity\Mail;
use App\Entity\User;
use DateTimeImmutable;
use App\Entity\ResetPassword;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ResetPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/reset/password', name: 'app_reset_password')]
    public function index(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_borrowing_index'); 
        }

        if ($request->get('username')) {  // Adjusted to use 'email' instead of 'username'
            // Look for the user by email
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $request->get('username')]);
            dd($user);  // Debugging output as shown in the example

            if ($user) {
                // Save the reset password request in the database
                $resetPassword = new ResetPassword();
                $resetPassword->setUser($user)
                    ->setToken(uniqid())
                    ->setCreatedAt(new DateTimeImmutable());

                $this->entityManager->persist($resetPassword);
                $this->entityManager->flush();

                // Generate the absolute URL for the password reset link
                $url = $this->generateUrl(
                    'update_password',
                    ['token' => $resetPassword->getToken()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                );

                // Prepare the email content
                $content = "Hello " . $user->getUsername() . "<br>In order to reset your password, please click on the following link:<br>";
                $content .= "<a href='" . $url . "'>Reset your password</a>.";

                // Send the email
                $mail = new Mail();
                $mail->send($user->getUsername(), null, 'Reset your password', $content);  // Assuming send method takes email as first parameter
                $this->addFlash("notice", "An email has been sent to you!");
            }
        }

        return $this->render('reset_password/index.html.twig');
    }

    #[Route('/update-password/{token}', name: 'update_password')]
    public function reset($token)
    {
        dd($token);  
    }
}
