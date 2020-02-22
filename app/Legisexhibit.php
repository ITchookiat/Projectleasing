<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Legisexhibit extends Model
{
  protected $table = 'Legisexhibits';
  // protected $primaryKey = 'Legisexhibit_id';
  protected $fillable = ['Contract_legis','Dateaccept_legis','Name_legis','Policestation_legis','Suspect_legis','Plaint_legis',
                        'Inquiryofficial_legis','Terminate_legis','Typeexhibit_legis','Currentstatus_legis','Nextstatus_legis',
                        'Noteexhibit_legis','Dategiveword_legis','Datecheckexhibit_legis','Datepreparedoc1_legis','Datesenddoc_legis',
                        'Dateinvestigate_legis','Resultexhibit1_legis','Datepreparedoc2_legis','Resultexhibit2_legis'];
}
