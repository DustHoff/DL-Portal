<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NexusArtifact extends Model
{
    public $timestamps=false;
    protected $fillable=["groupid","artifactid","classifier","extension"];
}
