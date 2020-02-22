<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegisexhibitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legisexhibits', function (Blueprint $table) {
            $table->bigIncrements('Legisexhibit_id');
            $table->string('Contract_legis')->nullable();
            $table->string('Dateaccept_legis')->nullable();
            $table->string('Name_legis')->nullable();
            $table->string('Policestation_legis')->nullable(); //สถานีภูธร
            $table->string('Suspect_legis')->nullable(); //ชื่อผู้ต้องหา
            $table->string('Plaint_legis')->nullable(); //ข้อหา
            $table->string('Inquiryofficial_legis')->nullable(); //พนักงานสอบสวน
            $table->string('Terminate_legis')->nullable(); //บอกเลิกสัญญา
            $table->string('Typeexhibit_legis')->nullable(); //ประเภทของกลาง
            $table->string('Currentstatus_legis')->nullable(); //สถานะปัจจุบัน
            $table->string('Nextstatus_legis')->nullable(); //สถานะต่อไป
            $table->string('Noteexhibit_legis')->nullable(); //หมายเหตุ
            $table->string('Dategiveword_legis')->nullable(); //วันที่ให้ปากคำ
            $table->string('Datecheckexhibit_legis')->nullable(); //วันที่เช็คสำนวน
            $table->string('Datepreparedoc1_legis')->nullable(); //วันที่เตรียมเอกสาร(ของกลาง)
            $table->string('Datesenddoc_legis')->nullable(); //วันที่ยื่นเอกสาร(ของกลาง)
            $table->string('Dateinvestigate_legis')->nullable(); //วันที่ไต่สวน(ของกลาง)
            $table->string('Resultexhibit1_legis')->nullable(); //ผล(ของกลาง)
            $table->string('Datepreparedoc2_legis')->nullable(); //วันที่เตรียมเอกสาร(ปปส.)
            $table->string('Resultexhibit2_legis')->nullable(); //ผล(ปปส.)
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
        Schema::dropIfExists('legisexhibits');
    }
}
