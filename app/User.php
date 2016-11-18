<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'type',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function hasType($type)
    {
        return $this->type == $type;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

