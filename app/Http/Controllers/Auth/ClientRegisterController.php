<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:client');
    }

    public function showRegisterForm()
    {
        return view('auth.client-register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:clients'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request['password'] = Hash::make($request->password);
        Client::create($request->all());

        return redirect()->intended(route('client.dashboard'));
    }
}