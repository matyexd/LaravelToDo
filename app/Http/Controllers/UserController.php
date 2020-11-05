<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\RegisterRequest;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public $successStatus = 200;

    public function user(Request $request){
        $code = $this->userService->code;
        return response()->json(Auth::user(), $code);
    }

    public function login(Request $request)
    {
        $data = $this->userService->loginUser($request->all());
        $code = $this->userService->code;
        return response()->json($data, $code);
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->userService->registerUser($request->all());
        $code = $this->userService->code;
        return response()->json($data, $code);
    }
}
