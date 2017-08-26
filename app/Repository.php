<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model implements IRepository
{

    public $timestamps = false;
    protected $hidden = ["repository","project","artifacts"];
    protected $appends = ["configuration"];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo|IRepository
     */
    public function repository()
    {
        return $this->morphTo();
    }

    public function project() {
        return $this->belongsTo("App\Project");
    }

    public function artifacts()
    {
        return $this->hasMany("App\Artifact", "repository_id", "id");
    }

    public function upload(Artifact $artifact)
    {
        $this->repository->upload($artifact);
    }

    public function download(Artifact $artifact, $version)
    {
        return $this->repository->download($artifact, $version);
    }

    public function version(Artifact $artifact)
    {
        return $this->repository->version($artifact);
    }

    public function getConfigurationAttribute(){
        return $this->repository;
    }
}
