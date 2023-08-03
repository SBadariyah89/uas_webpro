<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class SessionController extends Controller
{
    function indexDepan()
    {
        return view("sesi/indexdepan");
    }
    function login(Request $request)
    {
        Session::flash('name', $request->name);
        $request->validate([
            'name'=>'required',
            'password'=>'required'
        ],
        [
            'name.required'=>'name wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [
            'name' => $request->name,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)){
            return redirect('mahasiswa')->with('Login sukses');

        } else {
            return redirect('sesi')->withErrors('Name dan Password tidak valid');
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/sesi');
    }
}
