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

$router->post('/users', [
    'as' => 'users.create',
    'uses' => 'UserController@create'
]);

$router->group([
    'prefix' => 'auth'
], function ($router) {
    $router->post('login', 'AuthController@login');
});

$router->group([
    'prefix' => 'api',
    'middleware' => 'auth'
], function ($router) {
    $router->post('tags', [
        'as' => 'tags.create',
        'uses' => 'TagController@create'
    ]);
});
