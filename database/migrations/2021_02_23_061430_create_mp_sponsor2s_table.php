<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPSponsor2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MP_Sponsors2', function (Blueprint $table) {
            $table->bigIncrements('MP_Sponsor2_id');
            $table->integer('MP_id')->nullable();
            $table->string('name_SP2')->nullable();
            $table->string('lname_SP2')->nullable();
            $table->string('nikname_SP2')->nullable();
            $table->string('status_SP2')->nullable();
            $table->string('tel_SP2')->nullable();
            $table->string('relation_SP2')->nullable();
            $table->string('mate_SP2')->nullable();
            $table->string('idcard_SP2')->nullable();
            $table->string('add_SP2')->nullable();
            $table->string('addnow_SP2')->nullable();
            $table->string('statusadd_SP2')->nullable();
            $table->string('workplace_SP2')->nullable();
            $table->string('house_SP2')->nullable();
            $table->string('deednumber_SP2')->nullable();
            $table->string('area_SP2')->nullable();
            $table->string('housestyle_SP2')->nullable();
            $table->string('career_SP2')->nullable();
            $table->string('income_SP2')->nullable();
            $table->string('puchase_SP2')->nullable();
            $table->string('support_SP2')->nullable();
            $table->string('securities_SP2')->nullable();
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
        Schema::dropIfExists('MP_Sponsors2');
    }
}
