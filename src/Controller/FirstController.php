<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    // Attribut

    #[Route('/order/{maVar}', name: 'test.order.route')]
    public function testOrderRoute($maVar)
    {
        return new Response(
            "<html><body>$maVar</body></html>"
        );
    }

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
        return $this->render('first/hello.html.twig', [
            'nom' => $name,
            'prenom' => $firstname,
            "path" => '    ',
        ]);
    }

    #[Route('multi/{entier1<\d+>}/{entier2<\d+>}', name: 'app_multiplication')]
    // Fonction quiu retourne une Réponse car Symfony est un framework se basant sur un système de Requête / Réponse
    public function multiplication($entier1, $entier2)
    {
        $resultat = $entier1 * $entier2;
        return new Response("<h1>$resultat</h1>");
    }
}
