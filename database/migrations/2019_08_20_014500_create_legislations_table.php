<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegislationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legislations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Contract_legis')->nullable();
            $table->string('Name_legis')->nullable();
            $table->string('Idcard_legis')->nullable();
            $table->string('BrandCar_legis')->nullable();
            $table->string('register_legis')->nullable();
            $table->string('YearCar_legis')->nullable();
            $table->string('Category_legis')->nullable();
            $table->string('DateDue_legis')->nullable();
            $table->string('Pay_legis')->nullable();
            $table->string('BalancePrice_legis')->nullable();
            $table->string('DateSue_legis')->nullable();
            $table->string('DateVAT_legis')->nullable();
            $table->string('NameGT_legis')->nullable();
            $table->string('IdcardGT_legis')->nullable();
            $table->string('Realty_legis')->nullable();
            $table->string('Mile_legis')->nullable();
            $table->string('Period_legis')->nullable();
            $table->string('Countperiod_legis')->nullable();
            $table->string('Beforeperiod_legis')->nullable();
            $table->string('Afterperiod_legis')->nullable();
            $table->string('Sumperiod_legis')->nullable();
            $table->string('Note')->nullable();
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
        Schema::dropIfExists('legislations');
    }
}
