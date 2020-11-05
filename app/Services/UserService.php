<?php

namespace App\Services;

use App\Http\Controllers\UserController;
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
     * @return array|string[]
     */
    public function loginUser($input){
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('Todo')->accessToken;
            return ['success' => $success];
        }
        else {
            $this->code = 401;
            return ['error' => 'Unauthorised'];
        }
    }

    /**
     * @param $input
     * @return array
     */
    public function registerUser($input){
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('Todo')->accessToken;
        $success['name'] = $user->name;
        return ['success' => $success];
    }
}
