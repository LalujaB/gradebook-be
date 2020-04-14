<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    protected $fillable = [

        'title','professor_id'
    ];

    const STORE_RULES = [
        'title' => 'required|min:2',
        'professor_id' => 'required'
    ];

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
