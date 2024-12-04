<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function authenticate(Request $request)
    {

        $validator = validator()->make(
            $request->all(),
            [
                'email' => 'required','email',
                'password' => 'required',
            ]
        );

        if($validator->fails()){
            return $validator->errors();
            return response()->json($validator->errors(), 422);
        }

        $credentials = $validator->valid();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return response()->json('succefull', 200);
        }

        return response()->json('El usuario y/o contraseña no coinciden', 422);
    }
}
