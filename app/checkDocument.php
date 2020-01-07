<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkDocument extends Model
{
  protected $table = 'check_documents';
  protected $fillable = ['Datacar_id','Contracts_Car','Manual_Car','Act_Car','Insurance_Car',
                        'Key_Reserve','Expire_Tax','Date_NumberUser','Date_Expire','Check_Note'];

  public function datacarType()
  {
    return $this->belongsTo(data_car::class,'Datacar_id');
  }
}
