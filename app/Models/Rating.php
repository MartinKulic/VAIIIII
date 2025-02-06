<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Rating extends Model
{
    public $incrementing = false;

    use HasCompositeKey;

    protected $table = 'ratings';
    protected $fillable = ['user_id', 'image_id', 'value', 'updated_at'];
    protected $primaryKey = ['user_id', 'image_id'];

    protected $created_at = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }

    //---------------------

    public static function getRatingValueFor($imgId){

        return Rating::where('image_id', $imgId)->sum('value');
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getImageId(): int
    {
        return $this->image_id;
    }

    public function setImageId(int $image_id): void
    {
        $this->image_id = $image_id;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): void
    {
        $this->value = $value;
    }



}
