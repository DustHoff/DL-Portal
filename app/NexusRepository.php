<?php

namespace App;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\File;
use SimpleXMLElement;

class NexusRepository extends Model implements IRepository
{
    private $client;
    protected $fillable = ["url","username","password"];
    protected $hidden = ["id","created_at","updated_at"];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->client = new Client();
    }

    public function repository(){
        return $this->morphOne("App\Repository","repository");
    }

    /**
     * @param $url
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function webCall($url)
    {
        return $this->client->get($this->url . $url, ["stream" => true, "auth" => [$this->username, decrypt($this->password)]]);
    }

    public function version(Artifact $artifact)
    {
        $response = $this->webCall("/" . str_replace(".", "/", $artifact->groupid) . "/" . $artifact->artifactid . "/maven-metadata.xml");
        $xml = new SimpleXMLElement($response->getBody()->getContents());
        return (array)$xml->versioning->versions->version;
    }

    public function download(Artifact $artifact, $version)
    {
        $oldversion = $version;
        try {
            $response = $this->webCall("/" . str_replace(".", "/", $artifact->groupid) . "/" . $artifact->artifactid . "/$version/maven-metadata.xml");
            $xml = new SimpleXMLElement($response->getBody()->getContents());
            $snapshot = $xml->versioning->snapshot;
            $version = str_replace("SNAPSHOT", $snapshot->timestamp, $version) . "-" . $snapshot->buildNumber;
        } catch (\Exception $e) {
        }
        $filename = "$artifact->artifactid-$version" . (($artifact->classifier == null) ? "" : "-" . $artifact->classifier) . ".$artifact->extension";
        return $this->webCall("/" . str_replace(".", "/", $artifact->groupid) . "/$artifact->artifactid/$oldversion/$filename")
            ->withHeader("content-disposition", "attachment; filename=$filename");
    }

    /**
     * @param Artifact $artifact
     */
    public function upload(Artifact $artifact)
    {
        if(isset($artifact->file)) {
            Storage::delete($artifact->file);
            unset($artifact->file);
        }
        unset($artifact->version);
        $artifact->save();
        $this->repository->artifacts()->save($artifact);
    }
}
