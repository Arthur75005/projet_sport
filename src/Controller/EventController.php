<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Event;


class EventController extends Controller
{
    public function event()
    {

        $participe = $this->getDoctrine()->getRepository(User::class);
        $users = $participe->findByName("Arthur");
        dump($users);

    }

    public function create_event_post(Request $request)
    {
        $user = $this->getUser();
        if( $user ){
            $data = array("user" => array("prenom" => $user->getPrenom(), "nom" => $user->getNom()));
        } else {
            $data = array("user" => null);
        }

        $events = $this->getDoctrine()->getManager();
        $user = $this->getUser();

            $event = new Event();
            $event->setTypeEvent($request->get("type_event"));
            $event->setZone($request->get("zone"));
            $event->setEventName($request->get("name"));
            $event->setLongitude($request->get("longitude"));
            $event->setLatitude($request->get("latitude"));
            $event->setDateEvent(new \DateTime($request->get("date_event")));
            $event->setCategories($request->get("categories"));
            $event->setUser($user);
            
            
                $events->persist($event);
                $events->flush();

                return $this->render("base.html.twig",  $data);
    }

    public function create_event_view(Request $request)
    {
        
        $user = $this->getUser();
        if( $user ){
            $data = array("user" => array("prenom" => $user->getPrenom(), "nom" => $user->getNom()));
        } else {
            $data = array("user" => null);
        }
             
                return $this->render("event/create_event.html.twig",$data);
    }
    
}

