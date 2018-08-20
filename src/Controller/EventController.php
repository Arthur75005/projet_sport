<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;


class EventController extends Controller
{
    public function event()
    {

        $participe = $this->getDoctrine()->getRepository(User::class);
        $users = $participe->findByName("Arthur");
        dump($users);

    }
    
    
}