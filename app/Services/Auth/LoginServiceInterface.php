<?php

namespace App\Services\Auth;

interface LoginServiceInterface
{
    public function login(array $data);

    public function register(array $data);
}
