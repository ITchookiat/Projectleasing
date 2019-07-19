<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
  protected $table = 'buyers';
  protected $fillable = ['Contract_buyer','Date_Due','Name_buyer','last_buyer','Nick_buyer','Status_buyer','Phone_buyer','Phone2_buyer',
                        'Mate_buyer','Idcard_buyer','Address_buyer','AddN_buyer','StatusAdd_buyer','Workplace_buyer','House_buyer',
                        'Driver_buyer','HouseStyle_buyer','Career_buyer','Income_buyer','Purchase_buyer','Support_buyer'];

  public function Sponsor()
  {
    return $this->hasMany(Sponsor::class);
  }

  public function Cardetail()
  {
    return $this->hasMany(Cardetail::class);
  }

  public function UploadfileImage()
  {
    return $this->hasMany(UploadfileImage::class);
  }
  public function Expenses()
  {
    return $this->hasMany(Expenses::class);
  }
}
