<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legiscompromise extends Model
{
  protected $table = 'legiscompromises';
  protected $primaryKey = 'legisPromise_id';
  protected $fillable = ['legisPromise_id','KeyPay_id','Total_Promise','Type_Promise','DateNsale_Promise','Dateset_Promise',
                          'Payall_Promise','Pay1_Promise','Pay2_Promise','Pay3_Promise','Sum_Promise','Discount_Promise',
                          'Due_Promise','DuePay_Promise','Datelast_Promise','SumAll_Promise','Note_Promise'];

  public function legislationPromise()
  {
    return $this->belongsTo(Legislation::class,'legisPromise_id');
  }

  public function Legispayment()
  {
    return $this->hasMany(legispayment::class);
  }
}