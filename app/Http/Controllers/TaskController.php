<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //GET List
    public function list()
    {
        // On récupère nos catégories en base grace au model
        $tasksList = Task::all();

        // On renvoi tout ça en JSON ... et c'est tout !
        return response()->json($tasksList, 200);
    }

    //POST
    public function add(Request $request)
    {
        $task = new Task();
        // On rempli les propriétés de notre
        // nouvelle catégorie avec les infos envoyées en $_POST
        // On vérifie qu'on a pas reçu n'importe quoi au passage
        $task->title = $request->title;
        $task->category_id = $request->categoryId;
        $task->completion = $request->completion;
        $task->status = $request->status;

        $task->save();

        if (($task->save())==true) {
            // On renvoi tout ça en JSON ... et c'est tout !
            return response()->json($task, 201);}

        else return response()->json($task, 500);
    }

    //GET find
    public function find($id)
    {
        // On récupère nos catégories en base grace au model
        $task = Task::find($id);

        // On renvoi tout ça en JSON ... et c'est tout !
        return response()->json($task, 200);
    }

    //PUT (update all data)
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task->title = $request->title;
        $task->completion = $request->completion;
        $task->status = $request->status;

        $task->save([$id]);
    }

    //!PATCH (update partial data) pas encore fait
    /*
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        $task->title = $request->title;
        $task->completion = $request->completion;
        $task->status = $request->status;

        $task->save([$id]);
    }
    */

    // La méthode delete reçoit en paramètre les
    // variables de l'URL, définies dans la route
    public function delete($id)
    {
        // Méthode "S6"
        //$task = Task::find($id);
        //$task->delete();

        // Méthode DESTROY
        Task::destroy($id);
        return response()->json(null, 204);
    }
}
