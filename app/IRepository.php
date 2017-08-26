<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 26.07.2017
 * Time: 17:07
 */

namespace App;


use Illuminate\Http\Request;

interface IRepository
{
    public function upload(Artifact $artifact);
    public function download(Artifact $artifact, $version);
    public function version(Artifact $artifact);
}