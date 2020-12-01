<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'events_id';
    protected $fillable = ['title','color','start_date','end_date','Note_events',
                           'User_generate','Date_generate','Branch_user'];
}
