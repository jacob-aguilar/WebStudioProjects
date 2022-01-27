<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('perfil')->with('usuarios', $user)->with('no',1);
    }
    public function  crear_usuario(Request $request){

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = bcrypt($request->input("password"));

        $user->notify(new NewUserNotification($request->input("password")));
        $user->save();


        return redirect("perfil");
    }

    public function destroy(Request $request)
    {
        User::destroy($request->input("id"));

        return back()->with(["exito"=>"Se elimino exitosamente"]);


    }


}
