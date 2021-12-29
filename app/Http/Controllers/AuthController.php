<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('user.login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('nisn', $request->nisn)->first();
        if ($user && !is_null($user->date_of_birth) && ($request->date_of_birth == $user->date_of_birth) && ($request->password == $user->password)) {
            if (Auth::loginUsingId($user->id)) {
                toast('Kamu berhasil login!', 'success');
                return redirect()->route('user.dashboard');
            }
        }
        return redirect()->route('auth.showLogin')->with('error', 'Login Gagal. Cek kembali NISN, Tanggal Lahir dan Password kamu');
    }

    public function adminShowLogin()
    {
        return view('admin.login');
    }

    public function adminLogin(AdminLoginRequest $request)
    {
        $user = User::where('nisn', $request->nisn)->first();
        if ($user && ($request->password == $user->password)) {
            if ($user->role == 'adm') {
                if (Auth::loginUsingId($user->id)) {
                    toast('Kamu berhasil login!', 'success');
                    return redirect()->route('admin.dashboard');
                }
            } else {
                toast('Ooops. Kamu bukan admin!', 'error');
                return redirect()->back();
            }
        }
        return redirect()->route('auth.showLogin')->with('error', 'Login Gagal. Cek kembali NISN, Tanggal Lahir dan Password kamu');
    }

    public function register(RegisterRequest $request)
    {
        $payload = $request->all();
        try {
            User::create($payload);
            toast('Data berhasil ditambahkan!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Data gagal ditambahkan', 'error');
            return redirect()->back();
        }
    }

    public function update(AdminRequest $request, $id)
    {
        $payload = $request->all();
        try {
            User::findOrFail($id)->update($payload);
            toast('Data berhasil di update!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            toast('Data gagal di update', 'error');
            return redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toast('Kamu berhasil logout!', 'success');
        return redirect()->route('home.index');
    }
}