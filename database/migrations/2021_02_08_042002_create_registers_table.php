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
            $table->string('Status')->nullable();
            $table->date('DateStatus')->nullable();
            $table->string('NameCus_regis')->nullable();    //ชื่อ-สกุล
            $table->date('DateCus_regis')->nullable();    //วันที่รับ
            $table->string('Company_regis')->nullable();    //บริษัท
            $table->string('TypeReg_regis')->nullable();    //ประเภทโอน
            $table->string('Regno_regis')->nullable();      //ป้าย
            $table->string('NewRegno_regis')->nullable();   //ป้ายใหม่
            $table->string('Notes_regis')->nullable();      //หมายเหตุ
            $table->string('DocChk_regis')->nullable();    //เช็คเล่ม
            $table->string('KeyChk_regis')->nullable();    //เช็คกุญแจ
            $table->string('RecChk_regis')->nullable();    //เช็คใบเสร็จ

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
