<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPUploadfileImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MP_Uploadfile_images', function (Blueprint $table) {
            $table->bigIncrements('fileimage_id');
            $table->integer('MP_id')->nullable();
            $table->string('Type_fileimage')->nullable();
            $table->string('Name_fileimage')->nullable();
            $table->string('Size_fileimage')->nullable();
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
        Schema::dropIfExists('MP_Uploadfile_images');
    }
}
