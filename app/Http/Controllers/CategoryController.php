<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

// Si on veut pouvoir utiliser les constantes de codes HTTP
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    //GET List
    public function list()
    {
        return response()->json(Category::all(), 200);
    }

    //POST
    public function add(Request $request)
    {
        $category = new Category();

        //Validation
        $this->validate($request, [
            "name"      => "required|min:5|max:128|unique:categories",
            "status"     => "numeric|min:1|max:2",
        ]);

        $category->name       = $request->input("name");
        $category->status      = $request->input("status", 1);

        // la méthode save d'un model Eloquent renvoi un booléen
        // selon si la sauvegarde a fonctionné ou non
        if ($category->save()) {
            // La sauvegarde a fonctionné
            return response()->json($category, Response::HTTP_CREATED);
        }

        // La sauvegarde n'a pas fonctionné
        // On envoi une réponse vide et un code erreur 500
        return response("", Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    //GET find
    public function find($id)
    {
        // On récupère nos catégories en base grace au model
        $category = Category::find($id);

        // On renvoi tout ça en JSON ... et c'est tout !
        return response()->json($category, 200);
    }

    //PUT/PATCH (update all/partial data)
    public function edit(Request $request, $id)
    {
        // On récupère notre catégorie via son ID
        $categoryToUpdate = Category::find($id);

        // Si la tache existe (find renvoi null sinon)
        if ($categoryToUpdate !== null) {
            // Est-ce que c'est une requete en PUT ?
            if ($request->isMethod("put")) {
                // On vérifie que tous les champs sont présents ET remplis
                // Bonus : On pourrait aller plus loin en utilisant validate ;)
                if ($request->filled(["name", "status"])) {
                    // Mise à jour de l'objet Category
                    $categoryToUpdate->name     = $request->input("name");
                    $categoryToUpdate->status   = $request->input("status");
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
                if ($request->filled('name')) {
                    $categoryToUpdate->name = $request->input('name');
                    $oneDataAtLeast = true;
                }

                if ($request->filled('status')) {
                    $categoryToUpdate->status = $request->input('status');
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
            if ($categoryToUpdate->save()) {
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
        Category::destroy($id);
        return response()->json(null, 204);
    }
}
