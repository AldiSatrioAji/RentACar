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
$router->post('/pelanggan', 'PelangganController@create');
$router->get('/pelanggan', 'PelangganController@read');
$router->post('/pelanggan/{id}', 'PelangganController@update');
$router->delete('/pelanggan/{id}', 'PelangganController@delete');

$router->post('/mobil', 'MobilController@create');
$router->get('/mobil', 'MobilController@read');
$router->delete('/mobil/{id}', 'MobilController@delete');
$router->post('/mobil/{id}', 'MobilController@update');

$router->post('/sewa', 'SewaController@create');
$router->get('/sewa', 'SewaController@read');
$router->delete('/sewa/{id}', 'SewaController@delete');
$router->post('/sewa/{id}', 'SewaController@update');