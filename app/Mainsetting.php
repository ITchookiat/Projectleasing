<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mainsetting extends Model
{
    protected $table = 'mainsettings';
    protected $primaryKey = 'Set_id';
    protected $fillable = ['Dutyvalue_set','Marketvalue_set','Comagent_set','Taxvalue_set','Settype_set','Userupdate_set',
                            'Tabbuyer_set','Tabsponser_set','Tabcardetail_set','Tabexpense_set','Tabchecker_set','Tabincome_set'];
}
