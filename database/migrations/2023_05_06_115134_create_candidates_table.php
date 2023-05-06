<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('persons_id')->unsigned();
            $table->bigInteger('positions_id')->unsigned();
            $table->bigInteger('electionforms_id')->unsigned();
            $table->timestamps();
            $table->foreign('persons_id')->references('id')->on('persons')->onDelete('cascade');
            $table->foreign('positions_id')->references('id')->on('positions')->onDelete('cascade');
            $table->foreign('electionforms_id')->references('id')->on('electionforms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
