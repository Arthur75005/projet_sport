<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use App\Entity\Event;


class HomeController extends Controller
{
    public function home()
        {
            $er = $this->getDoctrine()->getRepository(Event::class);
            $events = $er->findAll();

            dump($events);

        $user = $this->getUser();
        if( $user ){
            $data = array("user" => array("prenom" => $user->getPrenom(), "nom" => $user->getNom()), "events" => $events);
        } else {
            $data = array("user" => null, "events" => $events);
        }
                
        return $this->render('base.html.twig', $data);

        // return $this->redirectToRoute('login');

    }
    
    
}