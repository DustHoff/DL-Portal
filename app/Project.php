<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $appends = ["route_key"];
    public function repositories(){
        return $this->hasMany("App\Repository");
    }

    public function getRouteKeyAttribute(){
        return $this->getRouteKey();
    }

    public function getRouteKey()
    {
        return strtolower(str_replace(" ","-",parent::getRouteKey()));
    }

    public function getRouteKeyName()
    {
        return "name";
    }
}
