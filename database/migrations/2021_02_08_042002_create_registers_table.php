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
        Schema::create('registers_Data', function (Blueprint $table) {
            $table->bigIncrements('Regis_id');
            $table->string('Buyer_id')->nullable();
            $table->string('Status_regis')->nullable();
            $table->date('DateStatus_regis')->nullable();
            $table->string('NameCus_regis')->nullable();
            $table->string('Status_regis')->nullable();
            $table->string('Status_regis')->nullable();
            $table->string('Status_regis')->nullable();
            $table->string('Status_regis')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registers_Data');
    }
}
