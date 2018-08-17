<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class Create_eventController Extends Controller
{
    public function create_event()
    {
        return $this->render("event/create_event.html.twig");
    }

}