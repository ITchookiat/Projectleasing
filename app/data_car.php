<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_car extends Model
{
  protected $table = 'data_cars';
  protected $fillable = ['Car_type','Origin_Car','create_date','Date_Status','Date_Soldout','Date_Repair','Date_Sale','Date_Color',
                        'Fisrt_Price','Brand_Car','Version_Car','Model_Car','Color_Car','Size_Car','Job_Number','Number_Miles','Gearcar',
                        'Year_Product','Number_Regist','Name_Sale','Repair_Price','Net_Price','Offer_Price','Color_Price',
                        'Date_Soldout_plus','Date_Withdraw','Net_Priceplus','Amount_Price','Name_Saleplus','Type_Sale','Name_Agent','Name_Buyer',
                        'Accounting_Cost'];

  public function datacar()
  {
    return $this->hasMany(checkDocument::class);
  }
}
