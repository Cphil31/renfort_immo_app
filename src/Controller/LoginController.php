<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Form\ResetPasswordFormType;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ResetPasswordRequestFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    #[Route('/oubli_pass', name:'forgotten_password')]
    public function forgottenPassword(
        Request $request,
        UserRepository $userRepository,
        TokenGeneratorInterface $tokenGenerator,
        EntityManagerInterface $entityManager,
        MailerInterface $mailer,
        ): Response
    {
        $form = $this->createForm(ResetPasswordRequestFormType::class);
        $form->handleRequest($request);

        //on vas chercher le mail 
        $email = $form->get('email')->getData();

        if ($form->isSubmitted() && $form->isValid()) {

            //on vas chercher l'utilisateur par son email 
            $user = $userRepository->findOneByEmail($email);

            if($user){
                //on generes un token 
                $token = $tokenGenerator->generateToken();

                //je le mets dans la base de données 
                $user->setResetToken($token);
                $entityManager->persist($user);
                $entityManager->flush();

            

                // on genreres un lien de réinitialisation du mot de passe 
                // il faut une nouvelle route 
                $url = $this->generateUrl('reset_pass',['token'=>$token,UrlGeneratorInterface::ABSOLUTE_URL]);
                
                // on crée les données du mail 
                $email = (new TemplatedEmail() )
                ->from('noreply@test.fr')
                ->to($user->getEmail())
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject('réinitialisation de mot de passe ')
                //->html('lien de récupération : https://devphil31.fr'. $url)
                ->htmlTemplate('mail/template.html.twig')
                ->context([
                    'url' => $url,
                ]);
                try {
                $mailer->send($email);
                } catch (\Throwable $th) {
                    dd($th);
                }
                $this->addFlash('success','Un email de récupération vous a été envoyé . Pensez a regarder les spams .');
                return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
            }
            
            return $this->redirectToRoute('forgotten_password', ['user' => $user], Response::HTTP_SEE_OTHER);
        }
              
        
        return $this->renderForm('security/reset_password_request.html.twig',[
            'form'=> $form,
            'user' => $email
        ]);
    }

    #[Route('/oubli_pass/{token}', name:'reset_pass')]
    public function resetPassword(
        string $token,
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher

    ):Response
    {
        // on verifies si on as le token dans la base de donnée 
        // c'est là qu'on fait la comparaison entre le token url et le token de la base de données 
        $user = $userRepository->findOneByResetToken($token);
        
        //si le token de l'url est le meme que dans la base de données
        if($user){
            $form = $this->createForm(ResetPasswordFormType::class);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                //on efface le token
                $user->setResetToken('');
                $password  = $form->get('password')->getdata();
                //on le hash
                $user->setPassword(
                    $passwordHasher->hashPassword(
                        $user,
                        $form->get('password')->getdata(),
                    )  
                );
                //on enregistre sur la base de données .
                $entityManager->persist($user);
                $entityManager->flush();
                return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
            }
            
            return $this->render('security/reset_password.html.twig', [
                'form'=>$form->createView(),
            ]);
        }
        $this->addFlash(
          'notice',
          'Vous êtes bien enregistrés '
      ); 
      

        return $this->redirectToRoute('app_login', [], Response::HTTP_SEE_OTHER);
    }

}
