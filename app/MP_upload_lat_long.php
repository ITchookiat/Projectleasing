<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MP_upload_lat_long extends Model
{
    protected $table = 'MP_Upload_lat_longs';
    protected $primaryKey = 'latlong_id';
    protected $fillable = ['MP_id','Buyer_latlong','Support_latlong','Buyer_note','Support_note'];

    public function Micro_Ploan()
    {
        return $this->belongsTo(Micro_Ploan::class,'MP_id');
    }
}
