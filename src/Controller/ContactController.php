<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContactController Extends Controller
{

    public function contact()
    {

        $user = $this->getUser();
        if( $user ){
            $data = array("user" => array("prenom" => $user->getPrenom(), "nom" => $user->getNom()));
        } else {
            $data = array("user" => null);
        }

             
            return $this->render("contact.html.twig", $data);

    }
}