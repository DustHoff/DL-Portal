<?php

namespace App\Http\Controllers;

use App\NexusArtifact;
use App\Project;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use SimpleXMLElement;

class DownloadController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Display a listing of the resource.
     *
     * @param Project $project
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        $versions = array();
        $configuration = $project->configuration;
        $artifacts = $configuration->artifacts;
        foreach ($artifacts as $artifact) {
            $response = $this->client->get($configuration->url . "/" . $artifact->groupid . "/" . $artifact->artifactid . "/maven-metadata.xml", ["auth" => [$configuration->user(), $configuration->pass()]]);
            $xml = new SimpleXMLElement($response->getBody()->getContents());
            $versions[$artifact->artifactid] = (array)$xml->versioning->versions->version;
        }
        return view("fragment.artifact.list",compact(["project","artifacts","versions"]));
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @param NexusArtifact $artifact
     * @param $version
     * @return Response
     */
    public function get(Project $project,NexusArtifact $artifact, $version)
    {
        $configuration = $project->configuration()->first();
        $response = $this->client->get("$configuration->url/$artifact->groupid/$artifact->artifactid/$version/$artifact->artifactid-$version.$artifact->extension", ["stream"=>true,"auth" => [$configuration->user(), $configuration->pass()]]);
        return $response->withHeader("content-disposition","attachment; filename=$artifact->artifactid-$version.$artifact->extension");
    }
}
