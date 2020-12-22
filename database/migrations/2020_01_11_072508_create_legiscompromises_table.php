<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegiscompromisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legiscompromises', function (Blueprint $table) {
            $table->bigIncrements('Promise_id');
            $table->string('Date_Promise')->nullable();
            $table->integer('legisPromise_id')->nullable();
            $table->integer('KeyPay_id')->nullable();           //Key ตารางผ่อนชำระ
            $table->string('Flag_Promise')->nullable();
            $table->string('Total_Promise')->nullable();        //ยอดประนอมหนี้
            $table->string('Type_Promise')->nullable();
            $table->string('DateNsale_Promise')->nullable();
            $table->string('Dateset_Promise')->nullable();
            $table->string('Payall_Promise')->nullable();       //ยอดเงินก้อนแรก
            $table->string('DateFirst_Promise')->nullable();    //นัดชำระก้อนแรก
            $table->string('Sum_Promise')->nullable();          //ยอดคงเหลือ
            $table->string('Discount_Promise')->nullable();     //ส่วนลด
            $table->string('Due_Promise')->nullable();          //จำนวนงวด
            $table->string('DuePay_Promise')->nullable();       //ชำระต่องวด
            $table->string('Sum_FirstPromise')->nullable();     //รวมก้อนแรก
            $table->string('Sum_DuePayPromise')->nullable();    //รวมค่างวด
            $table->string('DatePayment_Promise')->nullable();  //วันที่ชำระล่าสุด
            $table->integer('CashPayment_Promise')->nullable(); //จำนวนเงินชำระ
            $table->string('Note_Promise')->nullable();
            $table->string('User_Promise')->nullable();
            $table->string('Status_Promise')->nullable();
            $table->string('DateStatus_Promise')->nullable();
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
        Schema::dropIfExists('legiscompromises');
    }
}
