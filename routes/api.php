<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get("/project","ProjectController@index")->name("project.list");
Route::post("/project","ProjectController@create")->name("project.create");
Route::get("/project/{project}/repository","ProjectController@repository");
Route::post("/project/{project}/repository","RepositoryController@create");
Route::post("/project/{project?}/repository/{repository}/edit",function ($project,\App\Repository $repository, Request $request){
    return App::make("App\Http\Controllers\RepositoryController")->update($repository,$request);
});
Route::get("/project/{project?}/repository/{repository}",function ($project,\App\Repository $repository){
    return App::make("App\Http\Controllers\RepositoryController")->artifacts($repository);
});
Route::post("/project/{project?}/repository/{repository}",function ($project,\App\Repository $repository){
    return App::make("App\Http\Controllers\RepositoryController")->upload($repository);
});

Route::get("/repository/{repository}","RepositoryController@artifacts")->name("repository");
Route::get("/repository/{repository}/{artifact}","RepositoryController@version");
Route::get("/repository/{repository}/{artifact}/{version}","RepositoryController@download");

