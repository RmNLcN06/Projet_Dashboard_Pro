<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController
{
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        // Afficher notre tableau de todo
        // sinon je l'initialise puis j'affiche
        if (!$session->has('todos')) {
            $todos = [
                'achat' => 'acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "La liste des todos viens d'être initialisée");
        }
        // si j ai mon tableau de todo dans ma session je ne fait que l'afficher
        return $this->render('todo/index.html.twig');
    }

    #[Route('/todo/add/{name}/{content}', name: 'app_todo.add')]
    public function addTodo(Request $request, $name, $content)
    {
        $session = $request->getSession();
        // Vérifier si j ai mon tableau de todo dans la session
        if ($session->has('todos')) {
            // si oui
            // Vérifier si on a déjà un todd avec le meme name
            $todos = $session->get('todos');
            if (isset($todos[$name])) {
                // si oui afficher errerur
                $this->addFlash('error', "Le todo d'id $name existe déjà dans la liste");
            } else {
                // si non on l'ajouter et on affiche un message de succès
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "Le todo d'id $name a été ajouté avec succès");
            }
        } else {
            // si non
            // afficher une erreur et on va redirger vers le controlleur index
            $this->addFlash('error', "La liste des todos n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todo');
    }
}
