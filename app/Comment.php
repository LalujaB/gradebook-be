<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [

        'text','user_id','diary_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function diary()
    {
        return $this->belongsTo(Diary::class);
    }
}
