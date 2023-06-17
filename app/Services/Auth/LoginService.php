<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginService implements LoginServiceInterface
{

    public function login($data)
    {
        $credentials = [
            'mobile' => $data['mobile'],
            'password' => $data['password']
        ];
        if (!auth()->attempt($credentials)) {
            return response(['error_message' => 'Incorrect Details.
            Please try again']);
        }
        return auth()->user()->createToken('API Token')->accessToken;


    }

    public function register($data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);

        return $user->createToken('API Token')->accessToken;

    }
}
