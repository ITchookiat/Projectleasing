<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class legiscourtcase extends Model
{
  protected $table = 'legiscourtcases';
  protected $primaryKey = 'legislation_id';
  protected $fillable = ['legislation_id','datepreparedoc_case','noteprepare_case','datesetsequester_case','resultsequester_case',
                         'notesequester_case','paidsequester_case','datenextsequester_case','resultsell_case',
                         'datesoldout_case','amountsequester_case','NumAmount_case','Status_case','DateStatus_case','txtStatus_case','Flag_case'];

  public function legislationCourtcase()
  {
    return $this->belongsTo(Legislation::class,'legislation_id');
  }
}
