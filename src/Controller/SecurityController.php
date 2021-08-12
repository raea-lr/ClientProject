<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
           return $this->redirectToRoute('target_path');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $nameUser = $authenticationUtils->getNameUser();

        return $this->render('security/login.html.twig', ['last_username' => $nameUser, 'error' => $error]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function register(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $user=new User();
        $form=$this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $user->setIsvalider(true);
            //upload des images
            $file = $form->get('image')->getData();
            $uploads_directory = $this->getParameter('uploads_directory');
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $filename = $originalFilename . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename

            );
            $user->setImage($filename);
            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @param UserRepository $repository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route ("/updateProfile/{id}",name="updateProfile")
     */
    function update($id,UserRepository $repository,Request $request,UserPasswordEncoderInterface $encoder){
        $user=$repository->find($id);
        $form=$this->createForm(RegistrationType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            //upload des images
            $file = $form->get('image')->getData();
            $uploads_directory = $this->getParameter('uploads_directory');
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $filename = $originalFilename . '.' . $file->guessExtension();
            $file->move(
                $uploads_directory,
                $filename

            );
            $user->setImage($filename);
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("profile");


        }
        return $this->render('security/updateProfile.html.twig',
            [
                'f'=>$form->createView()
            ]);


    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile()
    {
        return $this->render('security/profile.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
