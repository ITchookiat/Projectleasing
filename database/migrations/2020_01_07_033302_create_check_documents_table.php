<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_documents', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('Datacar_id')->nullable();
          $table->string('Contracts_Car')->nullable();  //สัญญาซื้อขาย
          $table->string('Manual_Car')->nullable(); //คู่มือ
          $table->string('Act_Car')->nullable();  //พ.ร.บ
          $table->string('Insurance_Car')->nullable();  //ประกัน
          $table->string('Key_Reserve')->nullable();  //กุญแจ
          $table->string('Expire_Tax')->nullable(); //ป้ายภาษี

          $table->date('Date_NumberUser')->nullable();
          $table->date('Date_Expire')->nullable();
          $table->string('Check_Note')->nullable();
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
        Schema::dropIfExists('check_documents');
    }
}
