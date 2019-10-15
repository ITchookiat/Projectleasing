<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date_regis')->nullable();
            $table->string('Regno_regis')->nullable();
            $table->string('typeofrag_regis')->nullable();
            $table->string('comp_regis')->nullable();
            $table->string('custsurN_regis')->nullable();
            $table->string('newrag_regis')->nullable();
            $table->string('desc_regis')->nullable();
            $table->string('custamt_regis')->nullable();
            $table->string('recptamt_regis')->nullable();
            $table->string('techamt_regis')->nullable();
            $table->string('copyamt_regis')->nullable();
            $table->string('transinamt_regis')->nullable();
            $table->string('transamt_regis')->nullable();
            $table->string('newcar_regis')->nullable();
            $table->string('texamt_regis')->nullable();
            $table->string('ragamt_regis')->nullable();
            $table->string('docamt_regis')->nullable();
            $table->string('pipamt_regis')->nullable();
            $table->string('cancelamt_regis')->nullable();
            $table->string('otheramt_regis')->nullable();
            $table->string('emsamt_regis')->nullable();
            $table->string('ibamt_regis')->nullable();
            $table->string('copydate_regis')->nullable();
            $table->string('cashoutdate_regis')->nullable();
            $table->string('docchk_regis')->nullable();
            $table->string('keychk_regis')->nullable();
            $table->string('recchk_regis')->nullable();
            $table->string('docrecdate_regis')->nullable();
            $table->string('note_regis')->nullable();
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
        Schema::dropIfExists('registers');
    }
}
