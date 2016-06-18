<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
// =====================================================================================
Route::resource("cube_sumation_bases","CubeSumationBaseController");
Route::post('cube_sumation_bases/exec/{id}', [
  'as'   => 'exec', 
  'uses' => 'CubeSumationBaseController@exec'
]);
// =====================================================================================
Route::resource("cube_sumation_iterations","CubeSumationIterationController");
Route::get('cube_sumation_iterations/iterations_by_cube/{cube_id}', [
  'as'   => 'iterations_by_cube', 
  'uses' => 'CubeSumationIterationController@IterationsByCube'
]);
// =====================================================================================
Route::resource("cube_sumation_commands","CubeSumationCommandController");
Route::get('cube_sumation_commands/commands_by_iteration/{iteration_id}', [
  'as'   => 'commands_by_iteration', 
  'uses' => 'CubeSumationCommandController@CommandsByIteration'
]);
Route::get('cube_sumation_commands/create_by_iteration/{iteration_id}', [
  'as'   => 'create_by_iteration', 
  'uses' => 'CubeSumationCommandController@create_by_iteration'
]);
Route::get('cube_sumation_commands/index_query/{acum}', [
  'as'   => 'index_query', 
  'uses' => 'CubeSumationCommandController@index_query'
]);
