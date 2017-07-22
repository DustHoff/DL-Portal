<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectNexusConfiguration extends Model
{
    public $timestamps=false;
    public function user($value = null){
        if($value==null) return decrypt($this->attributes["username"]);
        else $this->attributes["username"]=encrypt($value);
    }

    public function pass($value=null){
        if($value==null) return decrypt($this->attributes["password"]);
        else $this->attributes["password"]=encrypt($value);
    }

    public function artifacts(){
        return $this->hasMany("App\NexusArtifact","project_id");
    }
}

