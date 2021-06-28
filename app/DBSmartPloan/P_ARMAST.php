<?php

namespace App\DBSmartPloan;

use Illuminate\Database\Eloquent\Model;

class P_ARMAST extends Model
{
    protected $connection = 'ibmi2';
    protected $table = 'PSFHP.ARMAST';
    protected $fillable = ['CONTNO','SDATE','HLDNO','MEMO1'];
  

    public function ConnectP_ARPAY()
    {
      return $this->hasOne(P_ARPAY::class,'CONTNO','CONTNO');
    }
}
