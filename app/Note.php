<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;  // debe llamarse para poder usarlo en la linea 18

class Note extends Model
{
    protected $table = "notes";

    protected $fillable = ['title','content','category_id'];

    public function setTitleAttribute($title)
    {
    	$this->attributes['title'] = strtoupper($title);
    }

    /**
     * @return array
     */
    public function getAppends()
    {
        return $this->appends;
    }

    public function scopeSearchTitle($query, $title)
    {
        if (! trim($title) == "") {
            return $query->where('title', 'LIKE', "%$title%, ")
                ->orWhere('content','LIKE', "%$title%");
        }
    }

    public function ownerOfNote()
    {
    	if ($this->user->id == Auth::user()->id) // tbn puede ser $this->user_id ya que me trae el del usuario quien creó la nota. y de la otra forma trae la relacion directa nota<->user con su id
    	{
    		return true;
    	}
    } 

    public function user() 
    {
    	return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
