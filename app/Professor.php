<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Diary;
use App\User;
use App\Image;

class Professor extends Model
{
    protected $fillable = [
        'url', 'user_id'
    ];

    public function diary()
    {
        return $this->hasOne(Diary::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function professorHasManyImages()
    {
        return $this->hasMany(Image::class);
    }
}
