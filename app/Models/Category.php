<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Automatiquement, Eloquent va par défaut chercher dans la table
    // correspondant au nom du modèle mis au pluriel :
    // Modèle Category => on va chercher dans la table 'categories'
    // Sj jamais, ça ne correspond pas au nom de notre table, on peut
    // toujours préciser à Lumen le nom de la table pour ce modèle
    // en rajoutant une propriété protected $table
    // A partir des champs de la table 'categories', Eloquent va
    // déduire automatiquement les propriétés du modèle Category !

    // En écrivant cette méthode, cela permet de définir une relation
    // entre les modèles Category et Task.
    //
    // Grâce à cette relation :
    //   => on sera capable d'aller chercher à la demande toutes les tâches
    // liées à une catégorie
    //
    // Et comme il peut y avoir plusieurs tâches dans une catégorie donnée :
    //   => on a donc une relation de type => One to many
    //
    // https://laravel.com/docs/6.x/eloquent-relationships#one-to-many
    public function tasks()
    {
        return $this->hasMany("App\Models\Task");
    }
}
