<?php

namespace App\Services;

use Illuminate\Auth\Events\Registered;

use App\Repositories\UserRepository;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepository $UserRepository)
    {
        $this->userRepository = $UserRepository;
    }

    public function createAccount($data)
    {

        $user = $this->userRepository->save($data);

        auth()->login($user);

        event(new Registered($user));
    }


}