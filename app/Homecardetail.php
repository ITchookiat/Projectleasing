<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homecardetail extends Model
{
  protected $table = 'homecardetails';
  protected $primaryKey = 'homecardetail_id';
  protected $fillable = ['homecardetail_id','Buyerhomecar_id','brand_HC','year_HC','colour_HC','oldplate_HC','newplate_HC',
                          'mile_HC','model_HC','type_HC','price_HC','downpay_HC','insurance_HC','transfer_HC','topprice_HC',
                          'interest_HC','vat_HC','period_HC','paypor_HC','payment_HC','payperriod_HC','tax_HC','taxperriod_HC',
                          'totalinstalments_HC','baab_HC','guarantee_HC','firstpay_HC','insure_HC','agent_HC','tel_HC','commit_HC',
                          'purchhis_HC','supporthis_HC','other_HC','sale_HC','approvers_HC','contrac_HC'];

  public function Buyerhomecardetails()
  {
    return $this->belongsTo(Buyer::class,'homecardetail_id');
  }
}