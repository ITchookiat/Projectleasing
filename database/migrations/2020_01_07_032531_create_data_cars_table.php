<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_cars', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('Car_type');
          $table->date('create_date');
          $table->date('Date_Status')->nullable();
          $table->string('Date_Soldout')->nullable();
          $table->string('Date_Repair')->nullable();
          $table->string('Date_Sale')->nullable();
          $table->string('Date_Color')->nullable();
          $table->string('Date_Wait')->nullable();
          $table->string('Brand_Car')->nullable();
          $table->string('Version_Car')->nullable();
          $table->string('Model_Car')->nullable();
          $table->string('Color_Car')->nullable();
          $table->string('Size_Car')->nullable();
          $table->string('Job_Number')->nullable();
          $table->string('Number_Miles')->nullable();
          $table->string('Gearcar')->nullable();
          $table->string('Year_Product')->nullable();
          $table->string('Number_Regist')->unique();
          $table->string('Name_Sale')->nullable();
          $table->string('Net_Price')->nullable();
          $table->string('Repair_Price')->nullable();
          $table->string('Fisrt_Price')->nullable();
          $table->string('Color_Price')->nullable();
          $table->string('Origin_Car')->nullable();
          $table->string('Offer_Price')->nullable();
          $table->string('Add_Price')->nullable();

          $table->date('Date_Soldout_plus')->nullable();
          $table->date('Date_Withdraw')->nullable();
          $table->string('Net_Priceplus')->nullable();
          $table->string('Amount_Price')->nullable();
          $table->string('Name_Saleplus')->nullable();
          $table->string('Type_Sale')->nullable();
          $table->string('Name_Agent')->nullable();
          $table->string('Name_Buyer')->nullable();
          $table->string('Accounting_Cost')->nullable();

          $table->date('Date_Borrowcar')->nullable();
          $table->date('Date_Returncar')->nullable();
          $table->string('Name_Borrow')->nullable();
          $table->string('Note_Borrow')->nullable();
          $table->string('BorrowStatus')->nullable();

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
        Schema::dropIfExists('data_cars');
    }
}
