<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPDatacarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MP_Datacars', function (Blueprint $table) {
            $table->bigIncrements('MP_Datacar_id');
            $table->integer('MP_id')->nullable();
            $table->string('Brand_car')->nullable();
            $table->string('Typecardetails')->nullable();
            $table->string('Groupyear_car')->nullable();
            $table->string('Year_car')->nullable();
            $table->string('Colour_car')->nullable();
            $table->string('IDTank_car')->nullable();
            $table->string('IDMachine_car')->nullable();
            $table->string('License_car')->nullable();
            $table->string('Nowlicense_car')->nullable();
            $table->string('Mile_car')->nullable();
            $table->string('Midprice_car')->nullable();
            $table->string('Model_car')->nullable();
            $table->date('DateFInsurance_car')->nullable();     //วันที่ทำประกัน         
            $table->date('DateLInsurance_car')->nullable();
            $table->date('DateFAct_car')->nullable();           //วันที่ทำ พ.ร.บ
            $table->date('DateLAct_car')->nullable();
            $table->date('DateFRegister_car')->nullable();      //วันที่ทำภาษี
            $table->date('DateLRegister_car')->nullable();
            $table->string('Top_car')->nullable();
            $table->string('Interest_car')->nullable();
            $table->string('Vat_car')->nullable();
            $table->string('Timeslacken_car')->nullable();
            $table->string('Pay_car')->nullable();
            $table->string('Paymemt_car')->nullable();
            $table->string('Timepayment_car')->nullable();
            $table->string('Tax_car')->nullable();
            $table->string('Taxpay_car')->nullable();
            $table->string('Totalpay1_car')->nullable();
            $table->string('Totalpay2_car')->nullable();
            $table->string('Dateduefirst_car')->nullable();
            $table->string('Insurance_car')->nullable();
            $table->string('status_car')->nullable();
            $table->string('Percent_car')->nullable();
            $table->string('Payee_car')->nullable();
            $table->string('IDcardPayee_car')->nullable();
            $table->string('Accountbrance_car')->nullable();
            $table->string('Tellbrance_car')->nullable();
            $table->string('Agent_car')->nullable();
            $table->string('IDcardAgent_car')->nullable();
            $table->string('Accountagent_car')->nullable();
            $table->string('Commission_car')->nullable();
            $table->string('Tellagent_car')->nullable();
            $table->string('Purchasehistory_car')->nullable();
            $table->string('Supporthistory_car')->nullable();
            $table->string('Loanofficer_car')->nullable();
            $table->string('Approvers_car')->nullable();
            $table->string('Date_Appcar')->nullable();
            $table->string('Check_car')->nullable();
            $table->string('StatusApp_car')->nullable();
            $table->string('DocComplete_car')->nullable();
            $table->string('branch_car')->nullable();
            $table->string('ManagerApp_car')->nullable();
            $table->string('branchbrance_car')->nullable();
            $table->string('branchAgent_car')->nullable();
            $table->string('Note_car')->nullable();
            $table->string('Insurance_key')->nullable();
            $table->string('Salemethod_car')->nullable();

            $table->string('AccountImage_car')->nullable();     //รูปหน้าเล่มบัญชี
            $table->string('UserCheckAc_car')->nullable();      //ลงชื่อ คนอนุมัติ
            $table->string('DateCheckAc_car')->nullable();      //วันที่ อนุมัติ

            $table->string('AgentNickname_car')->nullable();      //ฉายานายหน้า
            $table->string('AgentShop_car')->nullable();      //ชื่อเต้นท์(ร้าน)
            $table->string('AgentShoplocation_car')->nullable();  //ที่ตั้งเต้นท์(ร้าน)
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
        Schema::dropIfExists('MP_Datacars');
    }
}
