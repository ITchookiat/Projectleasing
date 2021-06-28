<?php

namespace App\DBSmartLeasing;

use Illuminate\Database\Eloquent\Model;

class S_ARPAY extends Model
{
    protected $connection = 'ibmi';
    protected $table = 'SFHP.ARPAY';
    protected $fillable = ['CONTNO','DAMT','PAYMENT','DTSTOPV'];
  
    public function S_ARPAYtoS_ARMAST()
    {
      return $this->belongsTo(S_ARMAST::class,'CONTNO','CONTNO');
    }
}
