<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function get($name){
        return view("fragment.configuration.$name");
    }
}
