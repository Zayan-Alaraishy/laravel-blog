<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }

    // Create New User
    public function store(RegisterRequest $request)
    {
        //validate incoming user data
        // Create User
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);


        // Login
        auth()->login($user);

        event(new Registered($user));


        return redirect('/home')->with('message', 'User created and logged in');
    }

    // Logout User
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/posts')->with('message', 'You have been logged out!');
    }

    // Show Login Form
    public function login()
    {
        return view('users.login');
    }

    // Authenticate User
    public function authenticate(LoginRequest $request)
    {
        $user = $request->validated();

        if (auth()->attempt($user)) {
            $request->session()->regenerate();
            // event(new Registered($user));


            return redirect('/posts')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
