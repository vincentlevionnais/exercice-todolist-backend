<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get(
    '/',
    [
        'uses' => 'MainController@home',
        'as'   => 'main-home'
    ]
);

/*
|---------------------|
|  ROUTES des taches  |
|---------------------|
*/

$router->get(
    "/tasks",
    [
        'uses' => 'TaskController@list',
        'as'   => 'task-list'
    ]
);

$router->post(
    "/tasks",
    [
        'uses' => 'TaskController@add',
        'as'   => 'task-add'
    ]
);

$router->get(
    "/tasks/{id}",
    [
        'uses' => 'TaskController@find',
        'as'   => 'task-find'
    ]
);

$router->put(
    "/tasks/{id}",
    [
        'uses' => 'TaskController@edit',
        'as'   => 'task-edit-put'
    ]
);

$router->patch(
    "/tasks/{id}",
    [
        'uses' => 'TaskController@edit',
        'as'   => 'task-edit-patch'
    ]
);

$router->delete(
    "/tasks/{id}",
    [
        'uses' => 'TaskController@delete',
        'as'   => 'task-delete'
    ]
);
