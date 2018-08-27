<?php

namespace App\Controller;


use App\Entity\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\NewEditMembreType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ProfileController Extends Controller
{
    public function profile(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $user = $this->getUser();
        if( $user ){
            $data = array("user" => array(
                "id" => $user->getId(), 
                "prenom" => $user->getPrenom(), 
                "nom" => $user->getNom(), 
                "phone" => $user->getPhone(), 
                "email" => $user->getEmail(), 
                "ville" => $user->getDepartement()
            ));
        } else {
            return $this->redirectToRoute('register');
        }
        dump($data);

        return $this->render("profile.html.twig", $data);

    }

    public function editProfile(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getRepository(User::class)->find($request->get("id"));
    
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$user
            );
        }
    
        $user->setPrenom($request->get("prenom"));
        $user->setNom($request->get("nom"));
        $user->setPhone($request->get("phone"));
        $user->setDepartement($request->get("ville"));

        $em->persist($user);
        $em->flush();
        
    
        return $this->returnJson(array("User modifier"), 201);
    }

    private function returnJson($data, $statusCode)
    {
        return new Response (json_encode($data), $statusCode, array("Content-Type" => "application/json") );
    }

}