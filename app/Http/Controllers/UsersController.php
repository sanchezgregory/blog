<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    public function profile()
    {
        $comments_disable = auth()->user()->comments()->onlyTrashed()->get(); // aqui en comments lleva parentesis porque se le aplica otro metodo. y luego get para obtener los valores

        $notes = auth()->user()->notes()->paginate(5);  // aqui quiero el atributo de las notas, y llamo a la relacion como un atributo.
                                                // tambien es posible obtener los valores con el get()
                                                // paginate trabaja como un get(), por eso no se pone get()
        // $user = auth()->user()->notes()->get() o asi $user = auth()->user()->notes()->paginate(10)

        //dd($user);

        //$users = auth()->user()->notes()->all();

        //return view('users.profile', compact('comments_disable'));
        return view('users.profile', compact('comments_disable', 'notes'));
    }

    public function deleteImg()
    {
        if (auth()->user()->avatar == 'avatars/default.png') {
            return abort(401);
        }

        Storage::delete(auth()->user()->avatar);

        auth()->user()->update([
            'avatar' => 'avatars/default.png'
        ]);

        flash('Su avatar ha sido borrado con exito', 'success');

        return back();
    }
}