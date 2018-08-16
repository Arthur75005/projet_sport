<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AboutController Extends Controller
{
    public function about()
    {
        return $this->render("about.html.twig");
    }
    
}