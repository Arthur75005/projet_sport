<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use App\Entity\Event;
use App\Repository\EventRepository;


class HomeController extends Controller
{
    public function home()
        {   
            $events = $this->getDoctrine()
            ->getRepository(Event::class)
            ->findAllEvents();

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

    public function marker(Request $request)
    {
        $marker = $this->getDoctrine()
        ->getRepository(Event::class)
        ->findAllEvents($request->get('zone'));

        for($i = 0; $i < count($marker); $i++){
            $marker[$i]['lat'] = floatval($marker[$i]['lat']);
            $marker[$i]['lng'] = floatval($marker[$i]['lng']);
        }


        return $this->returnJson(array("path" => "/marker", "data" => $marker));
    }

    private function returnJson($data)
    {
        return new Response (json_encode($data), 200, array("Content-Type" => "application/json") );
    }
    
    
}