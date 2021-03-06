<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micro_Ploan extends Model
{
    protected $table = 'MP_Datas';
    protected $fillable = ['Contract_MP','Flag','Type_Con','Date_Due','Name_MP','last_MP','Nick_MP','Status_MP','Phone_MP','Phone2_MP',
                          'Mate_MP','Idcard_MP','Address_MP','AddN_MP','StatusAdd_MP','Workplace_MP','House_MP',
                          'Driver_MP','HouseStyle_MP','Career_MP','CareerDetail_MP','ApproveDetail_MP','Income_MP','Purchase_MP','Support_MP',
                          'securities_MP','deednumber_MP','area_MP','BeforeIncome_MP','AfterIncome_MP','GradeMP_car','Objective_car','Walkin_id','SendUse_Walkin',
                          'Memo_MP','Prefer_MP','Memo_broker','Prefer_broker','MemoIncome_MP'];

    public function MP_Datacar()
    {
      return $this->hasMany(MP_Datacar::class);
    }
    public function MP_Sponsor()
    {
      return $this->hasMany(MP_Sponsor::class);
    }
    public function MP_Sponsor2()
    {
      return $this->hasMany(MP_Sponsor2::class);
    }
    public function MP_Expense()
    {
      return $this->hasMany(MP_Expense::class);
    }
    public function MP_uploadfile_image()
    {
      return $this->hasMany(MP_uploadfile_image::class);
    }
    public function MP_upload_lat_long()
    {
      return $this->hasMany(MP_upload_lat_long::class);
    }
}

