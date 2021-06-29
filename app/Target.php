<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = 'targets';
    protected $primaryKey = 'Target_id';
    protected $fillable = ['Target_Type','Target_Month','Target_Year','Target_Pattani','Target_Saiburi','Target_Kophor','Target_Yarang',
                           'Target_Yala','Target_Betong','Target_Bannangsta','Target_Yaha','Target_Narathiwat','Target_Kolok',
                           'Target_Tanyongmas','Target_Rosok','Target_Useradd'];
}
