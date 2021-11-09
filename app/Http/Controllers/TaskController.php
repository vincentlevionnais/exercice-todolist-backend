<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

// Si on veut pouvoir utiliser les constantes de codes HTTP
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    //GET List
    public function list()
    {
        return response()->json(Task::all(), 200);
    }

    //POST
    public function add(Request $request)
    {
        $task = new Task();

        //Validation
        $this->validate($request, [
            "title"      => "required|min:5|max:128|unique:tasks",
            "completion" => "numeric|min:1|max:100"
        ]);

        $task->title       = $request->input("title");
        $task->completion  = $request->input("completion", 1);

        // la méthode save d'un model Eloquent renvoi un booléen
        // selon si la sauvegarde a fonctionné ou non
        if ($task->save()) {
            // La sauvegarde a fonctionné
            return response()->json($task, Response::HTTP_CREATED);
        }

        // La sauvegarde n'a pas fonctionné
        // On envoi une réponse vide et un code erreur 500
        return response("", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    //GET find
    public function find($id)
    {
        // On récupère notre tâche en base grâce au model
        $task = Task::find($id);

        // On renvoi tout ça en JSON
        return response()->json($task, 200);
    }

    //PUT/PATCH (update all/partial data)
    public function edit(Request $request, $id)
    {
        // On récupère notre tache via son ID
        $taskToUpdate = Task::find($id);

        // Si la tache existe (find renvoi null sinon)
        if ($taskToUpdate !== null) {
            // Est-ce que c'est une requete en PUT ?
            if ($request->isMethod("put")) {
                // On vérifie que tous les champs sont présents ET remplis
                // Bonus : On pourrait aller plus loin en utilisant validate ;)
                if ($request->filled(["title", "completion"])) {
                    // Mise à jour de l'objet Task
                    $taskToUpdate->title       = $request->input("title");
                    $taskToUpdate->completion  = $request->input("completion");
                } else {
                    // Si manque des informations => mauvaise requête
                    return response("", Response::HTTP_BAD_REQUEST);
                }
            } else // Sinon c'est une requete en PATCH
            {
                // On va définir un booléen a false qui passera
                // a true si une valeur est remplie correctement dans la requete
                $oneDataAtLeast = false;

                // Pour chaque propriété, on vérifie si une modif est présente dans Request
                if ($request->filled('title')) {
                    $taskToUpdate->title = $request->input('title');
                    $oneDataAtLeast = true;
                }
                if ($request->filled('completion')) {
                    $taskToUpdate->completion = $request->input('completion');
                    $oneDataAtLeast = true;
                }

                // Si on a toujours $oneDataAtLeast = false, c'est qu'aucune donnée
                // correcte n'a été trouvée pour modifier notre objet => erreur
                // if( $oneDataAtLeast === false )
                if (!$oneDataAtLeast) {
                    return response("", Response::HTTP_BAD_REQUEST);
                }
            }

            // Si on arrive ici, c'est qu'on a pas rencontré d'erreur
            // On vérifie si la sauvegarde a marché
            if ($taskToUpdate->save()) {
                return response("", Response::HTTP_NO_CONTENT);
            } else {
                return response("", Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return response("", Response::HTTP_NOT_FOUND);
    }

    //DELETE
    public function delete($id)
    {
        Task::destroy($id);
        return response()->json(null, 204);
    }
}
