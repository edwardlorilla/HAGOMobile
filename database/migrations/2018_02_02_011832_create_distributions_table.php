<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);   /*( pure stand, random, border)*/
            $table->timestamps();
        });
        Schema::table('repositories', function (Blueprint $table){
            $table->integer('distribution_id')->unsigned()->index()->nullable();
            $table->foreign('distribution_id')->references('id')->on('distributions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('repositories', function (Blueprint $table) {
            $table->dropColumn(['distribution_id']);
        });
        Schema::dropIfExists('distributions');
    }
}
