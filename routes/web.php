<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
//Route::get("/control/project/","ProjectController@index")->name("project.list");

//Route::get("/control/project/form","ProjectController@create")->name("project.create");
//Route::post("/control/project/form","ProjectController@store")->name("project.store");
//Route::get("/control/project/form/{project}","ProjectController@edit")->name("project.edit");
//Route::post("/control/project/form/{project}","ProjectController@update")->name("project.update");
Route::get("/control","AdministrationController@index")->name("control.projects");
Route::get("/{project}","ProjectController@show")->name("project.show");



