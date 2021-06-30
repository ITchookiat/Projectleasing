<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->bigIncrements('Target_id');
            $table->string('Target_Type')->nullable();
            $table->string('Target_Month')->nullable();
            $table->string('Target_Year')->nullable();
            $table->string('Target_Pattani')->nullable();
            $table->string('Target_Saiburi')->nullable();
            $table->string('Target_Kophor')->nullable();
            $table->string('Target_Yarang')->nullable();
            $table->string('Target_Yala')->nullable();
            $table->string('Target_Betong')->nullable();
            $table->string('Target_Bannangsta')->nullable();
            $table->string('Target_Yaha')->nullable();
            $table->string('Target_Narathiwat')->nullable();
            $table->string('Target_Kolok')->nullable();
            $table->string('Target_Tanyongmas')->nullable();
            $table->string('Target_Rosok')->nullable();
            $table->string('Target_Dateadd')->nullable();
            $table->string('Target_Useradd')->nullable();
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
        Schema::dropIfExists('targets');
    }
}
