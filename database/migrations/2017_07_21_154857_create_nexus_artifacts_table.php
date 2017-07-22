<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNexusArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nexus_artifacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("project_id")->unsigned();
            $table->char("groupid");
            $table->char("artifactid");
            $table->char("classifier")->nullable();
            $table->char("extension",10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nexus_artifacts');
    }
}
