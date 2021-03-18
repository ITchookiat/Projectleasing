<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mainsettings', function (Blueprint $table) {
            $table->bigIncrements('Set_id');
            $table->string('Dutyvalue_set')->nullable();
            $table->string('Marketvalue_set')->nullable();
            $table->string('Comagent_set')->nullable();
            $table->string('Taxvalue_set')->nullable();
            $table->string('Settype_set')->nullable();
            $table->string('Interesttype_set')->nullable();

            $table->string('Tabbuyer_set')->nullable();
            $table->string('Tabsponser_set')->nullable();
            $table->string('Tabcardetail_set')->nullable();
            $table->string('Tabexpense_set')->nullable();
            $table->string('Tabchecker_set')->nullable();
            $table->string('Tabincome_set')->nullable();

            $table->string('Userupdate_set')->nullable();
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
        Schema::dropIfExists('mainsettings');
    }
}
