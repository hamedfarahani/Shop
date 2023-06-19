<?php

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginService implements LoginServiceInterface
{

    public function login($data)
    {

        $user = User::whereMobile($data['mobile'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            $token= $user->createToken('API Token');;
            $response = ['token' => $token->accessToken];
            return response($response, 200);
        }
        return response(['error' => 'Invalid credentials'], 401);

    }

    public function register($data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);

        return $user->createToken('API Token');

    }
}
