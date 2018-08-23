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
            $data = array("user" => array("prenom" => $user->getPrenom(), "nom" => $user->getNom()));
        } else {
            $data = array("user" => null);
        }

        return $this->render("profile.html.twig", $data);

    }

    public function editProfile($user,Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($user);
    
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id '.$user
            );
        }
    
        $user->setPrenom($request->get("prenom"));
        $user->setNom($request->get("nom"));
        $user->setemail($request->get("email"));
        $user->setPhone($request->get("phone"));
        $user->setDepartement($request->get("ville"));
        $em->persist($user);
        $em->flush();
    
        return $this->redirectToRoute('profile.html.twig', [
            'id' => $user->getId()
        ]);
    }

}