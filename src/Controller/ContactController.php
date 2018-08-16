<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContactController Extends Controller
{
    public function contact()
    {
        return $this->render("contact.html.twig");
    }
    
}