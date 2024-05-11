<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('Auth.login');
    }

    public function validerPasswordForm()
    {
        return view('Auth.firstLogin');
    }

    public function validerPassword(Request $request, $id)
    {
        $request->validate(
            [
                "password" => "required",
            ]
        );
        //si c'est changer de mot de passe pour lapremiere connexion
        if ($id == 0) {

            
            $user = auth()->user();
            $u = Utilisateur::find($user->id);
            //dd( $u->authentification);
            $u->authentification = 1;
            $u->password = Hash::make($request['password']);
            //dd( $user->password);
            $u->save();

            return redirect()->intended(route('clients.index'));
        }

        //sinon
        $u = Utilisateur::find($id);
        $pass = $request['password'];
        //dd($pass);
        $u->password = Hash::make($pass);
        $u->save();

        return redirect()->route('auth.login')->withErrors(['error' => 'mot de passe bien changer']);
    }

    public function forgotPasswordForm()
    {
        return view('Auth.forgotPassword');
    }



    public function forgotPassword(Request $request)
    {
        $request->validate(
            [
                "email" => "required",
                "numeroClient" => "required",
                "numeroCI" => "required",
            ]
        );

        $email = $request['email'];
        $numC = $request['numeroClient'];
        $numCI = $request['numeroCI'];
        $u = Utilisateur::where('email', $email)->where('numero', $numC)->where('numeroCI', $numCI)->first();

        if ($u !== null) {
            // L'utilisateur a été trouvé

            $id = $u->id;

            return redirect()->route('auth.validerPasswordForm', compact('id'));
        }


        return redirect()->route('auth.forgotPasswordForm')->withErrors(['error' => 'Informations incorrecte'])->onlyInput('email');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        //dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $profil = $user->id_profil;

            //session->regenerate;
            $request->session()->regenerate();

            if ($profil === 1) {
                return redirect()->route('admins.index');
            } else {

                if ($user->authentification == 0) {
                    //dd($user -> authentification);
                    return redirect()->route('auth.validerPasswordForm');
                }


                return redirect()->intended(route('clients.index'));
            }
        };

        return redirect()->route('auth.login')->withErrors(['error' => 'email ou mot de passe incorrecte'])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
