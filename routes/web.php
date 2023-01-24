<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('login',  ['uses' => 'AuthController@login']);
$router->post('register', ['uses' => 'AuthController@register']);
$router->get('/user/me/todoNotes',  ['middleware' => "verifyLoggedIn", 'uses' => 'TodoNoteController@currentUserNotes']);
$router->get('/user/{username}/todoNotes',  ['uses' => 'TodoNoteController@userNotes']);
$router->post('todoNote', ['middleware' => "verifyLoggedIn",'uses' => 'TodoNoteController@create']);
$router->delete('todoNote/{id}', ['middleware' => ["verifyLoggedIn", "verifyNoteOwner"], 'uses' => 'TodoNoteController@delete']);
$router->patch('todoNote/{id}/complete', ['middleware' => ["verifyLoggedIn", "verifyNoteOwner"], 'uses' => 'TodoNoteController@setComplete']);

