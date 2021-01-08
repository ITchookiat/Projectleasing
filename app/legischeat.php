<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class legischeat extends Model
{
    protected $table = 'legischeats';
    protected $primaryKey = 'legislation_id';
    protected $fillable = ['legislation_id','DateNotice_cheat','Dateindictment_cheat','DateExamine_cheat',
                           'Datedeposition_cheat','Dateplantiff_cheat','Status_cheat','DateStatus_cheat','note_cheat'];
  
    public function legislationCheat()
    {
      return $this->belongsTo(Legislation::class,'legislation_id');
    }
}
