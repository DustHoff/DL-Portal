<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function configuration() {
        return $this->morphTo();
    }
}