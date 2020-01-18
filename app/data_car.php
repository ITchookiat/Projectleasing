<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_car extends Model
{
  protected $table = 'data_cars';
  protected $fillable = ['Car_type','create_date','Date_Status','Date_Soldout','Date_Repair','Date_Sale','Date_Color','Date_Wait',
                        'Brand_Car','Version_Car','Model_Car','Color_Car','Size_Car','Job_Number','Number_Miles','Gearcar',
                        'Year_Product','Number_Regist','Name_Sale','Net_Price','Repair_Price','Offer_Price','Fisrt_Price',
                        'Origin_Car','Color_Price','Offer_Price','Add_Price','Date_Soldout_plus','Date_Withdraw','Net_Priceplus',
                        'Amount_Price','Name_Saleplus','Type_Sale','Name_Agent','Name_Buyer','Accounting_Cost','Date_Borrowcar',
                        'Date_Returncar','Name_Borrow','Note_Borrow','BorrowStatus'];

  public function datacar()
  {
    return $this->hasMany(checkDocument::class);
  }
}
