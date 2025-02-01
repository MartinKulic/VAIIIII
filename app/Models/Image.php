<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['autor_id', 's_date', 'caption', 'desc', 'name', 'path'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //--------------------------------------

    public function getRatings(){
        return Rating::where(`image_id`, $this->id);
    }
}
