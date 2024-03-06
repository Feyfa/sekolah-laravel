<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {   
        // -----jika ingin membuat akun admin, ini di nonaktifkan-----
        // ------------------------------------------------------------------------------------------
        // pengecek apakah account admin benar atau tidak, jika tidak lupakan semua nya, langsung berikan kesalahan
        $usernameAdmin = $request->input('usernameAdmin');
        $passwordAdmin = $request->input('passwordAdmin');
        
        $admin = Admin::where('username', $usernameAdmin)->get();
        
        if(count($admin) > 0) {
            if(!(Hash::check($passwordAdmin, $admin[0]->password))) {
                return redirect('/register')->with('admin-invalid', 'admin account is invalid');
            }
        }
        else {
            return redirect('/register')->with('admin-invalid', 'admin account is invalid');
        }
        // ------------------------------------------------------------------------------------------
        // -----jika ingin membuat akun admin, ini di nonaktifkan-----

        
        


        // ------------------------------------------------------------------------------------------
        // membuat account ke user
        // -----jika ingin membuat akun admin, ini di nonaktifkan-----
        $validatedDataUser = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'kelas_id' => ['required', 'unique:users,kelas_id'],
            'username' => ['required', 'min:5', 'max:255', 'unique:users,username'],
            'password' => ['required', 'min:5', 'max:255']
        ]);
        $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
        // -----jika ingin membuat akun admin, ini di nonaktifkan-----
        
        // -----jika ingin membuat akun user, ini di Aktifkan-----
        // $validatedDataAdmin = $request->validate([
        //     'name' => ['required', 'min:3', 'max:255'],
        //     'jabatan' => ['required'],
        //     'username' => ['required', 'min:5', 'max:255', 'unique:users'],
        //     'password' => ['required', 'min:5', 'max:255']
        // ]);
        // $validatedDataAdmin['password'] = Hash::make($validatedDataAdmin['password']);
        // -----jika ingin membuat akun user, ini di Aktifkan-----

        
        // -----jika ingin membuat akun admin, ini di nonaktifkan-----
        User::create($validatedDataUser);
        // -----jika ingin membuat akun admin, ini di nonaktifkan-----
        
        // -----jika ingin membuat akun user, ini di Aktifkan-----
        // Admin::create($validatedDataAdmin);
        // -----jika ingin membuat akun user, ini di Aktifkan-----

        
        return redirect('/login')->with('flash', [
            'status' => 'success',
            'message' => 'Register Success'
        ]);
        // ------------------------------------------------------------------------------------------
    }
}
