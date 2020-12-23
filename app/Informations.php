<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informations extends Model
{
    protected $table = 'informations';
    protected $primaryKey = 'Info_id';
    protected $fillable = ['name_info','SDate_info','EDate_info','Notes_info','content_info',
                           'Status_info','User_generate','Date_generate','UserPN_Noted','UserYL_Noted','UserNR_Noted'];
}
