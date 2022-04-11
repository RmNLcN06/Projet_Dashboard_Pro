<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    // Attribut
    // '/first' est la Requete
    #[Route('/first', name: 'app_first')]
    // Fonction quiu retourne une Réponse car Symfony est un framework se basant sur un système de Requête / Réponse
    public function index(): Response
    {
        // die('Je suis la requete /first');
        return $this->render('first/index.html.twig', [
            'controller_name' => 'FirstController',
        ]);
    }

    #[Route('/sayHello/{name}/{firstname}', name: 'app_say.hello')]
    // Fonction quiu retourne une Réponse car Symfony est un framework se basant sur un système de Requête / Réponse
    public function sayHello(Request $request, $name, $firstname): Response
    {
        dd($request);
        return $this->render('first/hello.html.twig', [
            'nom' => $name,
            'prenom' => $firstname,
        ]);
    }
}
