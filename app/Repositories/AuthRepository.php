<?php

namespace App\Repositories;

use App\Contracts\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthRepository implements AuthRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function login(array $credentials){
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $user = Auth::user();
            // $token = $user->createToken('authToken')->plainTextToken;

            return [
                'user' => $user,
                // 'token' => $token,
            ];
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('auth/login')->with('success', 'Logged out successfully.');
    }


    public function getAuthenticatedUser(){

    }

    public function register(array $credentials){
        $user = User::create([
            'username' => $credentials['username'],
            'password' => Hash::make($credentials['password']),
            'name' => $credentials['username'],
            'email' => 'zakiaman23@gmail.com'
        ]);

        // $token = $user->createToken('authToken')->plainTextToken;
        $data = [
            'user' => $user,
            // 'token' => $token
        ];

        return $data;
    }

    public function getUser($id)
    {
        return response()->json($this->user->getUserById($id), 200);
    }

    public function getAllUser()
    {
        return $this->user->getAllUser();
    }
}
