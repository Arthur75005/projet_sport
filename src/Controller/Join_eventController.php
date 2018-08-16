<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class Join_eventController Extends Controller
{
    public function join_event()
    {
        return $this->render("event/join_event.html.twig");
    }
    
}