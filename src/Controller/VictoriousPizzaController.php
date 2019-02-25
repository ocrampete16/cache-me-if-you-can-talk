<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VictoriousPizzaController extends AbstractController
{
    /**
     * @Route("/victorious/pizza", name="victorious_pizza")
     */
    public function index()
    {
        return $this->render('victorious_pizza/index.html.twig', [
            'controller_name' => 'VictoriousPizzaController',
        ]);
    }
}
