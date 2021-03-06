<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MP_uploadfile_image extends Model
{
    protected $table = 'MP_Uploadfile_images';
    protected $primaryKey = 'fileimage_id';
    protected $fillable = ['MP_id','Type_fileimage','Name_fileimage','Size_fileimage'];
  
    public function Micro_Ploan()
    {
        return $this->belongsTo(Micro_Ploan::class,'MP_id');
    }
}
