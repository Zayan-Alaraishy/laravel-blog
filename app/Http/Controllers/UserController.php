<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;


class UserController extends Controller
{

    protected $userService;

    /**
     * UserController Constructor
     *
     * @param UserService $userService
     *
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create()
    {
        return view('users.register');
    }

    // Create New User
    public function store(RegisterRequest $request)
    {
        // Create User
        $message = '';

        try {
            $this->userService->createAccount($request);

            $message = 'User created and logged in';
        } catch (Exception $e) {
            $message = 'Someting went wrong while creating your account';
        }

        return redirect('/posts')->with('message', $message);
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
            return redirect('/posts')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}