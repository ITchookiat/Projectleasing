<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MP_Sponsor extends Model
{
    protected $table = 'MP_Sponsors';
    protected $primaryKey = 'MP_Sponsor_id';
    protected $fillable = ['MP_id','name_SP','lname_SP','nikname_SP','status_SP','tel_SP','relation_SP','mate_SP',
                          'idcard_SP','add_SP','addnow_SP','statusadd_SP','workplace_SP','house_SP','deednumber_SP',
                          'area_SP','housestyle_SP','career_SP','income_SP','puchase_SP','support_SP','securities_SP','MemoIncome_SP'];
  
    public function Micro_Ploan()
    {
      return $this->belongsTo(Micro_Ploan::class,'MP_id');
    }
}
