<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function createForm()
    {
        return view('signup');
    }

    public function create(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'confirmPass' => ['required']
        ], [
            'email.required' => "Preencha o campo de e-mail",
            'password.required' => "Preencha o campo de senha",
            'confirmPass.required' => "Preencha o campo de confirmação de senha"
        ]);

        if ($request->password !== $request->confirmPass) {
            return redirect()->back()->with('danger', 'As senhas estão diferentes');
        }

        $emailExists = DB::table('usuarios')->where('email', $request->email)->first();
        if ($emailExists) {
            return redirect()->back()->with('danger', 'Esse email já existe no banco de dados');
        }

        Usuario::create([
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [
            'email.required' => "Preencha o campo de e-mail",
            'password.required' => "Preencha o campo de senha"
        ]);



        if (Auth::attempt($credentials)) {
            $userInfo = DB::table('usuarios')->where('email', $request->email)->first();
            return redirect()->route('signup2', ['user_id' => $userInfo->id]);
        } else {
            return redirect()->back()->with('danger', 'E-mail ou senha inválida');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
