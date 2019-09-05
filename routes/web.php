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

$router->group(["prefix" => "/api/users"], function () use ($router){
    $router->get('/', "UserController@getUsers");
    $router->get('/{id}', "UserController@getUser");
    $router->post('/', "UserController@addUser");
    $router->put('/{id}', "UserController@updateUser");
    $router->delete('/{id}', "UserController@deleteUser");
});

