<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
  public function list()
  {
    //On prépare notre tableau en PHP
    $categoriesList = [
        1 => [
          'id' => 1,
          'name' => 'Chemin vers O\'clock',
          'status' => 1
        ],
        2 => [
          'id' => 2,
          'name' => 'Courses',
          'status' => 1
        ],
        3 => [
          'id' => 3,
          'name' => 'O\'clock',
          'status' => 1
        ],
        4 => [
          'id' => 4,
          'name' => 'Titre Professionnel',
          'status' => 1
        ]
      ];

      return response()->json( $categoriesList );
  }
}
