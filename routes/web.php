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

use Illuminate\Support\Facades\DB;

$router->get('/', function () use ($router) {
    return $router->app->version();
//    dd(DB::getPDO());
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('employees',  ['uses' => 'EmployeesController@index']);

    $router->get('employees/{id}', ['uses' => 'EmployeesController@show']);

    $router->post('employees', ['uses' => 'EmployeesController@create']);

    $router->delete('employees/{id}', ['uses' => 'EmployeesController@delete']);

    $router->put('employees/{id}', ['uses' => 'EmployeesController@update']);

    $router->get('filter/superior/{id}/subordinates', ['uses' => 'EmployeesController@getSuperiorSubordinates']);

    $router->get('filter/employees/{position}', ['uses' => 'EmployeesController@filterByPosition']);
});
