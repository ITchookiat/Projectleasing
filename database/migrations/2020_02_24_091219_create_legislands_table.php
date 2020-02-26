<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegislandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislands', function (Blueprint $table) {
            $table->bigIncrements('Legisland_id');
            $table->string('Date_legis')->nullable();
            $table->string('ContractNo_legis')->nullable();
            $table->string('Name_legis')->nullable();
            $table->string('Idcard_legis')->nullable();
            $table->string('DateDue_legis')->nullable();
            $table->string('Pay_legis')->nullable();
            $table->string('DateSue_legis')->nullable();
            $table->string('Realty_legis')->nullable();
            $table->string('Mile_legis')->nullable();         //เลขไมล์
            $table->string('Period_legis')->nullable();       //ค่างวด
            $table->string('Countperiod_legis')->nullable();  //จำนวนงวดทั้งหมด
            $table->string('Beforeperiod_legis')->nullable(); //ผ่อนมาแล้ว กี่งวด
            $table->string('Beforemoey_legis')->nullable();   //เป็นจำนวนเงิน กี่งวด
            $table->string('Remainperiod_legis')->nullable(); //จำนวนงวดที่ค้าง
            $table->string('Staleperiod_legis')->nullable();  //จำนวนงวดค้าง
            $table->string('Realperiod_legis')->nullable();   //จำนวนงวดที่ค้างจริง
            $table->string('Sumperiod_legis')->nullable();    //เหลือเป็นจำนวนเงิน เท่าไร
            $table->string('StatusContract_legis')->nullable(); //สถานะ
            $table->string('Flag')->nullable();
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
        Schema::dropIfExists('legislands');
    }
}
