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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'Login\LoginController@index');
$router->post('/register', 'UserController@register');
$router->get('/user/{id}', ['middleware' => 'auth', 'uses' => 'User\UserController@get_user']);
$router->get('/libertyFlavour', ['middleware' => 'auth', 'uses' => 'Liberty\FlavourController@get_flavour']);
$router->get('/barangs', ['middleware' => 'auth', 'uses' => 'Barang\BarangController@get_barang']);