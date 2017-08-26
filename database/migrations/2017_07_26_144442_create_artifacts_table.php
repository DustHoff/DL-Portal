<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artifacts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger("repository_id")->nullable();
            $table->char("artifactid",100);
            $table->char("groupid",100)->nullable();
            $table->char("version",16)->nullable();
            $table->char("classifier",32)->nullable();
            $table->char("extension",16);
            $table->char("file",100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artifacts');
    }
}
