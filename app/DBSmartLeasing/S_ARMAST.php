<?php

namespace App\DBSmartLeasing;

use Illuminate\Database\Eloquent\Model;

class S_ARMAST extends Model
{
    protected $connection = 'ibmi';
    protected $table = 'SFHP.ARMAST';
    protected $fillable = ['CONTNO','ISSUDT','HLDNO','MEMO1'];
  

    public function ConnectS_ARPAY()
    {
      return $this->hasOne(S_ARPAY::class,'CONTNO','CONTNO');
    }
}
