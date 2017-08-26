<?php

namespace App\Http\Controllers;

use App\Artifact;
use App\Http\Requests\ArtifactRequest;
use App\NexusRepository;
use App\Project;
use App\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RepositoryController extends Controller
{

    public function create (Project $project, Request $request){
        $nexus = new NexusRepository;
        $nexus->fill($request->json()->all());
        if($request->json("id")!=null) $nexus->exists=true;
        $nexus->save();
        $repo = new Repository;
        $repo->repository()->associate($nexus);
        $project->repositories()->save($repo);
        return $project->repositories;
    }

    public function update (Repository $repository,Request $request){
        $repoConfig = $repository->repository;
        $repoConfig->fill($request->json()->all());
        $repoConfig->save();
        return;
    }

    public function artifacts(Repository $repository)
    {
        //dd($repository);
        return $repository->artifacts;
    }

    public function version(Repository $repository, Artifact $artifact)
    {
        return $repository->version($artifact);
    }

    public function download(Repository $repository, Artifact $artifact, $version)
    {
        return $repository->download($artifact, $version);
    }

    public function upload(Request $request,Repository $repository){
        $artifact = new Artifact;
        $artifact->groupid = $request->get("groupid");
        $artifact->artifactid = $request->get("artifactid");
        $artifact->version = $request->get("version");
        if($request->hasFile("file")){
            $artifact->file = $request->file("file")->store($repository->project->name);
            $artifact->extension = $request->file("file")->extension();
        } else {
            $artifact->extension = $request->get("extension");
        }
        $repository->upload($artifact);
    }
}
