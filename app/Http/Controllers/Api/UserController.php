<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    function login(Request $request)
    {
        $validator = validator()->make(
            $request->all(),
            [
                'email' => 'required',
                'email',
                'password' => 'required',
            ]
        );

        if ($validator->fails()) {
            //return $validator->errors();
            return response()->json($validator->errors(), 422);
        }

        $credentials = $validator->valid();

        if (auth()->attempt($credentials)) {
            // $request->session()->regenerate();
            $token = auth()->user()->createToken('myapptoken')->plainTextToken;
            session()->put('token', $token);
            return response()->json([
                'isLoggedIn' => true,
                'token' => $token,
                'user' => auth()->user()
            ]);
        }

        return response()->json('El usuario y/o contraseña no coinciden', 422);
    }

    function logout(Request $request)
    {
        if ($request->user()) {
            //$request->user()->currentAccessToken()->delete();
            $request->user()->tokens()->delete();
        }
        session()->flush();
        return response()->json('ok');
    }

    public function checkToken()
    {
        try {
            [$id, $token] = explode('|', request('token'));
            $tokenHash = hash('sha256', $token);
            $tokenModel = PersonalAccessToken::where('token', $tokenHash)->first();
            if($tokenModel) {
                //Auth::login($tokenModel->tojenable);
                return response()->json([
                    'isLoggedIn' => true,
                    'token' => $token,
                    'user' => auth()->user()
                ]);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return response()->json('invalid user', 422);
    }
}
