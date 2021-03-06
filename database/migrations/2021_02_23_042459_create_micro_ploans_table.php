<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicroPloansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MP_Datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Contract_MP')->nullable();
            $table->string('Flag')->nullable();
            $table->string('Type_Con')->nullable();
            $table->date('Date_Due')->nullable();
            $table->string('Name_MP')->nullable();
            $table->string('last_MP')->nullable();
            $table->string('Nick_MP')->nullable();
            $table->string('Status_MP')->nullable();
            $table->string('Phone_MP')->nullable();
            $table->string('Phone2_MP')->nullable();
            $table->string('Mate_MP')->nullable();
            $table->string('Idcard_MP')->nullable();
            $table->string('Address_MP')->nullable();
            $table->string('AddN_MP')->nullable();
            $table->string('StatusAdd_MP')->nullable();
            $table->string('Workplace_MP')->nullable();
            $table->string('House_MP')->nullable();
            $table->string('Driver_MP')->nullable();
            $table->string('HouseStyle_MP')->nullable();
            $table->string('Career_MP')->nullable();
            $table->string('CareerDetail_MP', "MAX")->nullable();
            $table->string('ApproveDetail_MP', "MAX")->nullable();
            $table->string('Income_MP')->nullable();
            $table->string('Purchase_MP')->nullable();
            $table->string('Support_MP')->nullable();
            $table->string('securities_MP')->nullable();
            $table->string('deednumber_MP')->nullable();
            $table->string('area_MP')->nullable();
            $table->string('BeforeIncome_MP')->nullable();
            $table->string('AfterIncome_MP')->nullable();
            $table->string('GradeMP_car')->nullable();
            $table->string('Objective_car')->nullable();
            $table->string('Walkin_id')->nullable();
            $table->string('SendUse_Walkin')->nullable();
            $table->string('Memo_MP', "MAX")->nullable();
            $table->string('Prefer_MP', "MAX")->nullable();
            $table->string('Memo_broker', "MAX")->nullable();
            $table->string('Prefer_broker', "MAX")->nullable();
            $table->string('MemoIncome_MP', "MAX")->nullable();

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
        Schema::dropIfExists('MP_Datas');
    }
}
