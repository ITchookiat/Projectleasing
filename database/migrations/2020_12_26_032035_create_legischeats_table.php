<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegischeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legischeats', function (Blueprint $table) {
            $table->bigIncrements('cheat_id');
            $table->integer('legislation_id')->nullable();
            $table->string('DateNotice_cheat')->nullable();
            $table->string('Dateindictment_cheat')->nullable();
            $table->string('DateExamine_cheat')->nullable();
            $table->string('Datedeposition_cheat')->nullable();
            $table->string('Dateplantiff_cheat')->nullable();
            $table->string('Status_cheat')->nullable();
            $table->string('DateStatus_cheat')->nullable();
            $table->string('note_cheat')->nullable();
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
        Schema::dropIfExists('legischeats');
    }
}
