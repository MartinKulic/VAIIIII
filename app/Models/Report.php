<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $fillable = ['id', 'image_id', 'user_id', 'reason', 'created_at'];
    protected $primaryKey = 'id';
    protected $updated_at = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
}
