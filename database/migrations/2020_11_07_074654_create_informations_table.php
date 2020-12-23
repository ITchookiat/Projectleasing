<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->bigIncrements('Info_id');
            $table->string('name_info')->nullable();
            $table->string('SDate_info')->nullable();
            $table->string('EDate_info')->nullable();
            $table->longText('Notes_info')->nullable();
            $table->longText('content_info')->nullable();
            $table->string('Status_info')->nullable();
            $table->string('User_generate')->nullable();
            $table->string('Date_generate')->nullable();
            $table->string('UserPN_Noted')->nullable();
            $table->string('UserYL_Noted')->nullable();
            $table->string('UserNR_Noted')->nullable();
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
        Schema::dropIfExists('informations');
    }
}
