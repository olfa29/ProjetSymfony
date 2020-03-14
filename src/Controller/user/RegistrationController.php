<?php

namespace App\Controller\user;

use App\Entity\Users;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Users();
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

        
               
                $file = $form['image']->getData();
           
                $filename = md5(uniqid()).'.'.$file->guessExtension();
                try{
                    $file->move(
                        $this->getParameter('uploads_directory'),
                        $filename
                    );
                }catch(FileException $e){
    
                }
              
                $entityManager = $this->getDoctrine()->getManager();
                $user->setImage($filename);
                $entityManager->persist($user);
                $entityManager->flush();
    
                // do anything else you need here, like send an email
    
                return $this->redirectToRoute('app_login');
            }
    
            return $this->render('User/registration/register.html.twig', [
                'registrationForm' => $form->createView(),
            ]);
        }
    }
