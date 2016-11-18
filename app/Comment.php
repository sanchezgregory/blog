<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = "comments";
    protected $date = ['deleted_at']; // se hace esto para decir que date es una instance de carbon. Las fechas se instancian con carbon

    protected $fillable = ['user_id','note_id','content'];

    public function ownerOfComment()
    {
        // if ($this->user->id == auth()->id) // esto es con el helper auth().
        if ($this->user->id == Auth::user()->id) // tbn puede ser $this->user_id ya que me trae el del usuario quien creó la nota. y de la otra forma trae la relacion directa nota<->user con su id
        {
            return true;
        }
    }

    public function note()
    {
        return $this->belongsTo(Note::class); // belongsto recibe como parametro en este caso la clase de la nota
    }

    public function user()
    {
        return $this->belongsTo(User::class); // belongsto recibe como parametro en este caso la clase usuario
    }

}
