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
Route::get("/project/","ProjectController@index")->name("project.list");
Route::get("/project/{project}","ProjectController@show")->name("project.show");
Route::get("/project/form","ProjectController@create")->name("project.create");
Route::post("/project/form","ProjectController@store")->name("project.store");
Route::get("/project/form/{project}","ProjectController@edit")->name("project.edit");
Route::post("/project/form/{project}","ProjectController@update")->name("project.update");

Route::get("/project/{project}/download","DownloadController@index")->name("artifact.list");
Route::get("/project/{project}/download/{artifact}/{version}","DownloadController@get")->name("artifact.get");

Route::get("control","AdministrationController@index")->name("control.projects");

