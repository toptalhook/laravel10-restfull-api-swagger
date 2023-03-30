<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ResponseTrait;

    public function login(Request $request)
    {
        // check the request for the valid user email
        $user = User::query()->where('email', $request->email)->first();
        if (!$user) {
            return $this->responseSuccess([], 'User not found.');
        }
        // check the password
        if (Hash::check($request->password, $user->password)) {
            $createdToken = $user->createToken('authToken');
            $data = [
                'user' => $user,
                'access_token' => $createdToken->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($createdToken->token->expires_at)->toDateTimeString()
            ];
            return $this->responseSuccess($data, "Logged in successfully.");
        }
    }
}
