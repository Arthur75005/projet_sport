<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use App\Entity\User;


class HomeController extends Controller
{
    public function home()
    {

        $er = $this->getDoctrine()->getRepository(User::class);
        // $users = $er->findByPrenom("Arthur");
        // dump($users);





        $user = $this->getUser();
        if( $user ){
            $data = array("user" => array("prenom" => $user->getPrenom(), "nom" => $user->getNom()));
        } else {
            $data = array("user" => null);
        }
                
        return $this->render('base.html.twig', $data);

        // return $this->redirectToRoute('login');

    }
    
    
}