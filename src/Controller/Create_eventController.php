<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Event;


class Create_eventController Extends Controller
{
    public function create_event()
    {
        
        $events = $this->getDoctrine()->getManager();

            $event = new Event();
            $event->setTypeEvent($request->get("type_event"));
            $event->setZone($request->get("zone"));
            $event->setDate_event($request->get("date_event"));
            $event->setCategories($request->get("categories"));
            
            
                $events->persist($event);
                $events->flush();

                return $this->render("event/create_event.html.twig");
    }

}