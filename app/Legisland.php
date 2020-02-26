<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legisland extends Model
{
  protected $table = 'legislands';
  protected $primaryKey = 'Legisland_id';
  protected $fillable = ['Date_legis','ContractNo_legis','Name_legis','Idcard_legis','DateDue_legis','Pay_legis','DateSue_legis','Realty_legis','Mile_legis','Period_legis','Countperiod_legis',
                        'Beforeperiod_legis','Beforemoey_legis','Remainperiod_legis','Staleperiod_legis','Realperiod_legis','Sumperiod_legis','StatusContract_legis','Flag'];
}
