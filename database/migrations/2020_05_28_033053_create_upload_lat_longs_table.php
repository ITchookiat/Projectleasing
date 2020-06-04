<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadLatLongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_lat_longs', function (Blueprint $table) {
            $table->bigIncrements('latlong_id');
            $table->integer('Use_id')->nullable();
            $table->string('B_lat')->nullable();
            $table->string('B_long')->nullable();
            $table->string('SP_lat')->nullable();
            $table->string('SP_long')->nullable();
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
        Schema::dropIfExists('upload_lat_longs');
    }
}
