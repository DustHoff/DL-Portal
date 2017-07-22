<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Project;
use App\ProjectNexusConfiguration;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\BinaryOp\Mod;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view("fragment.project.list",compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("fragment.project.form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        return $this->update($request,null);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("project",compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view("fragment.project.form",compact("project"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest|Request $request
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project = null)
    {
        if($project==null){
            $project = new Project;
            $configuration= new ProjectNexusConfiguration;
            $configuration->url=$request->get("url");
            $configuration->user($request->get("username"));
            $configuration->pass($request->get("password"));
            $configuration->save();
        }
        else {
            $configuration = $project->configuration;
        }
        $configuration->artifacts()->each(function (Model $model){
            $model->delete();
        });
        $length = sizeof($request->get("groupid"));
        for ($i=0;$i<$length;$i++){
            $configuration->artifacts()->create([
                "groupid" => $request->get("groupid")[$i],
                "artifactid" => $request->get("artifactid")[$i],
                "classifier" => $request->get("classifier")[$i],
                "extension" => $request->get("extension")[$i]
            ]);
        }
        $project->name=$request->get("name");
        $project->desc=$request->get("desc");
        $project->configuration()->associate($configuration);
        $project->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
