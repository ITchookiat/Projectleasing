<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data_customer extends Model
{
    protected $table = 'data_customers';
    protected $primaryKey = 'Customer_id';
    protected $fillable = ['License_car','Brand_car','Model_car','Typecardetails','Top_car','Year_car','Phone_buyer','Phone_agent',
                          'Resource_news','Note_car','Branch_car','Type_leasing','Status_leasing'];
}