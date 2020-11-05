<?php

namespace App\Services;

use App\Models\User;
use App\Services\ModelService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */

class UserService extends ModelService
{
    /**
     * @param $input
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser($input){
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], 200);
        }
        else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }


    public function registerUser($input){
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success' => $success], 200);
    }
}
