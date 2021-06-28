<?php

namespace App\DBSmartPloan;

use Illuminate\Database\Eloquent\Model;

class P_ARPAY extends Model
{
    protected $connection = 'ibmi2';
    protected $table = 'PSFHP.ARPAY';
    protected $fillable = ['CONTNO','LOCAT','N_DAMT','PAYMENT','DTSTOPV'];
  
    public function P_ARPAYtoP_ARMAST()
    {
      return $this->belongsTo(P_ARMAST::class,'CONTNO','CONTNO');
    }
}
