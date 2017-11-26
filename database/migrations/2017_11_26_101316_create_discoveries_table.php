<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscoveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discoveries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->float('latitude')->nullable();
            $table->float('altitude')->nullable();
            $table->float('longitude')->nullable();
            $table->timestamps();
        });
        Schema::create('discovery_repository', function (Blueprint $table) {
            $table->integer('discovery_id')->unsigned()->index();
            $table->foreign('discovery_id')->references('id')->on('discoveries')->onDelete('cascade');;
            $table->integer('repository_id')->unsigned()->index();
            $table->foreign('repository_id')->references('id')->on('repositories')->onDelete('cascade');
        });
        Schema::create('discovery_photo', function (Blueprint $table) {
            $table->integer('discovery_id')->unsigned()->index();
            $table->foreign('discovery_id')->references('id')->on('discoveries')->onDelete('cascade');;
            $table->integer('photo_id')->unsigned()->index();
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discoveries');
        Schema::dropIfExists('discovery_repository');
        Schema::dropIfExists('discovery_photo');
    }
}
