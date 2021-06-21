<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //GET List
    public function list()
    {
        // On récupère nos catégories en base grace au model
        $categoriesList = Category::all();

        // On renvoi tout ça en JSON ... et c'est tout !
        return response()->json($categoriesList, 200);
    }

    //POST
    public function add(Request $request)
    {
        $category = new Category();
        // On rempli les propriétés de notre
        // nouvelle catégorie avec les infos envoyées en $_POST
        // On vérifie qu'on a pas reçu n'importe quoi au passage
        $category->name = $request->name;
        $category->status = $request->status;

        $category->save();

        if (($category->save()) == true) {
            // On renvoi tout ça en JSON ... et c'est tout !
            return response()->json($category, 201);
        } else return response()->json($category, 500);
    }

    //GET Find
    public function find($id)
    {
        // On récupère nos catégories en base grace au model
        $category = Category::find($id);

        // On renvoi tout ça en JSON ... et c'est tout !
        return response()->json($category, 200);
    }

    //PUT (update all data)
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->name = $request->name;
        $category->status = $request->status;

        $category->save([$id]);
    }

    //!PATCH (update partial data) pas encore fait
    /*
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $category->name = $request->name;
        $category->status = $request->status;

        $category->save([$id]);
    }
    */

    // La méthode delete reçoit en paramètre les
    // variables de l'URL, définies dans la route
    public function delete($id)
    {
        // Méthode "S6"
        //$category = Category::find( $id );
        //$category->delete();

        // Méthode DESTROY
        Category::destroy($id);
        return response()->json(null, 204);
    }
}
