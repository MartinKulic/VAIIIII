<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Fav extends Model
{
    use HasCompositeKey;

    protected $table = 'favs';
    protected $fillable = ['user_id', 'image_id', 'created_at'];

    protected $primaryKey = ['user_id', 'image_id'];

    protected $updated_at = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    //--------------------------------------

}
