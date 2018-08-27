<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginController extends Controller
{
    public function login(Request $request, AuthenticationUtils $authenticationUtils )
    {  
        $user = new User();
        $form = $this->createForm(LoginType::class, $user);

        $form->handleRequest($request);
        $error = $authenticationUtils->getLastAuthenticationError();

        if ($form->isSubmitted() && $form->isValid())
        {
            return $this->render("include/base.html.twig");
        }

        return $this->render("connexion/signin.html.twig", array(
            "formulaire" => $form->createView(),
            "error" => $error
        ));
    }
    
    public function postRegister(Request $request, UserPasswordEncoderInterface $encoder)
    {
        if(!filter_var($request->get("email"), FILTER_VALIDATE_EMAIL))
        {
            return $this->returnJson(array("Syntaxe email invalide"), 401); 
        }
        $er = $this->getDoctrine()->getRepository(User::class);

        $userOne = $er->findOneBy(["email" => $request->get("email")]);

        if(!$userOne)
        {
            $em = $this->getDoctrine()->getManager();

            $user = new User();
            $user->setPrenom($request->get("firstname"));
            $user->setNom($request->get("lastname"));
            $user->setEmail($request->get("email"));
            $user->setDepartement($request->get("departement"));
            $user->setPassword($encoder->encodePassword($user, $request->get("password")));

            try
            {
                $em->persist($user);
                $em->flush();
            }
            catch(\Doctrine\ORM\EntityNotFoundException $e)
            {
                return $this->returnJson(array("Error: Invalide request"), 501);
            }
            

            if(true)
            {             
                return $this->returnJson(array("User created"), 201);
            }
            else
            {
                return $this->returnJson(array("User isn't creat"), 401);      
            }
        }
        else
        {
            return $this->returnJson(array("User is already use!"), 401);      
        }
        dump($user);

    }

    public function logout()
    {
        return $this->redirectionToRoute("index");
    }

    private function returnJson($data, $statusCode)
    {
        return new Response (json_encode($data), $statusCode, array("Content-Type" => "application/json") );
    }

}