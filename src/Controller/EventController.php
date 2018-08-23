<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        
        $events = $this->getDoctrine()->getManager();
        $user = $this->getUser();

            $event = new Event();
            $event->setTypeEvent($request->get("type_event"));
            $event->setZone($request->get("zone"));
            $event->setDateEvent(new \DateTime($request->get("date_event")));
            $event->setCategories($request->get("categories"));
            $event->setUser($user);
            
            
                $events->persist($event);
                $events->flush();

                return $this->render("event/create_event.html.twig");
    }

    public function create_event_view()
    {
        
        // $events = $this->getDoctrine()->getManager();

        //     $event = new Event();
        //     $event->setTypeEvent($request->get("type_event"));
        //     $event->setZone($request->get("zone"));
        //     $event->setDate_event($request->get("date_event"));
        //     $event->setCategories($request->get("categories"));
            
            
        //         $events->persist($event);
        //         $events->flush();

                return $this->render("event/create_event.html.twig");
    }
}


