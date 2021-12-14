<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact')]
class  ContactControlleur extends  AbstractController{
    #[Route('/', name:'contact' , methods:['GET'])]
public function index() : Response{
        return $this->render('contactControlleur/contact.html.twig');

    }
}