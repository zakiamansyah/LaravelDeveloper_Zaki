<?php

namespace App\Contracts;

interface AuthRepositoryInterface
{
    public function login(array $credentials);

    public function logout();

    public function getAuthenticatedUser();

    public function register(array $requst);

    public function getUser($id);

    public function getAllUser();
}
