<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Repositories\contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function username()
    {
        return 'username';
    }

    public function login(LoginRequest $request)
    { 
     
        if (Auth::attempt($request->validated())) {
            return ResponseHelper::success("app.responses.loginSuccess", [
                "user" => new UserResource(Auth::user()->load('roles', 'roles.permissions')),
                "token" => Auth::user()->createToken("Api Token")->plainTextToken,
            ]);
        } else {
            return ResponseHelper::error("app.responses.invalidCredentials", null);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ResponseHelper::success("app.responses.logoutSuccess", null);
    }

    public function getUser(Request $request)
    {
        return ResponseHelper::findSuccess("user", new UserResource(Auth::user()->load('roles', 'roles.permissions')));
    }
}