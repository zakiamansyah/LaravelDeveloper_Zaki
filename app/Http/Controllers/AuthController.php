<?php

namespace App\Http\Controllers;

use App\Contracts\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function generateCsrfToken(){
        echo csrf_token();
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $check = $this->authRepository->login($request->only('username', 'password'));

        if($check){
            return redirect()->route('order');
        }
    }

    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput();
        }

        $check = $this->authRepository->register($request->only('username', 'password'));

        if($check){
            return redirect()->route('login');
        }
    }

    public function getUser($id){

        return $this->authRepository->getUser($id);
    }
}
