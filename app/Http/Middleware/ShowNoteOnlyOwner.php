<?php

namespace App\Http\Middleware;

use App\Note;
use Closure;

class ShowNoteOnlyOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $note = Note::findOrFail($request->id); // buscamos el id de la nota mediante

        if ($note->ownerOfNote()) {
            return $next($request);
        } else {
            flash('No eres dueño de la nota','danger');
            return redirect()->back();
        }

    }
}
