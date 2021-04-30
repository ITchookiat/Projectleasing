<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MP_Expense extends Model
{
    protected $table = 'MP_Expenses';
    protected $primaryKey = 'MP_Expense_id';
    protected $fillable = ['MP_id','act_Price','closeAccount_Price','P2_Price','vat_Price','tran_Price','other_Price','evaluetion_Price','totalk_Price','balance_Price',
                          'commit_Price','marketing_Price','duty_Price','insurance_Price','note_Price','BookCheck_car'];
  
    public function Micro_Ploan()
    {
        return $this->belongsTo(Micro_Ploan::class,'MP_id');
    }
}
