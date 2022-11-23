<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PessoaController extends Controller
{
    public function info($user_id)
    {
        $user = DB::table('pessoas')->where('user_id', $user_id)->first();

        if ($user) {
            return redirect()->route('dashboard', ['user_id' => $user_id]);
        }

        return view('userInfo');
    }


    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'age' => ['required']
        ], [
            'name.required' => "Preencha o campo de nome",
            'age.required' => "Preencha o campo de idade"
        ]);

        $userId = auth()->user()->id;

        Pessoa::create([
            'user_id' => $userId,
            'name' => $request->name,
            'age' => $request->age
        ]);

        return redirect()->route('dashboard', ['user_id' => $userId]);
    }

    public function dashboard($user_id)
    {
        $userInfo = DB::table('pessoas')->where('user_id', $user_id)->first();

        return view('dashboard', ['userInfo' => $userInfo]);
    }

    public function delete(Request $request, $user_id)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        DB::table('pessoas')->where('user_id', $user_id)->delete();
        DB::table('usuarios')->where('id', $user_id)->delete();

        return redirect('/');
    }

    public function updateForm($user_id)
    {
        $userInfo = DB::table('pessoas')->where('user_id', $user_id)->first();

        return view('changeInfo', ['userInfo' => $userInfo]);
    }

    public function update(Request $request, $user_id)
    {
        $validated = $request->validate([
            'name' => ['required'],
            'age' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [
            'name.required' => "Preencha o campo de nome",
            'age.required' => "Preencha o campo de idade",
            'email.required' => "Preencha o campo de email",
            'password.required' => "Preencha o campo de senha"
        ]);

        if ($request->password !== $request->confirmPass) {
            return redirect()->back()->with('danger', 'As senhas estão diferentes');
        }


        DB::table('pessoas')->where('user_id', $user_id)->update([
            'name' => $request->name,
            'age' => $request->age
        ]);

        $emailExists = DB::table('usuarios')->where('email', $request->email)->first();

        if ($emailExists) {
            DB::table('usuarios')->where('id', $user_id)->update([
                'email' => auth()->user()->email,
                'password' => Hash::make($request->password)
            ]);
        } else {
            DB::table('usuarios')->where('id', $user_id)->update([
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('dashboard', ['user_id' => $user_id]);
    }
}
