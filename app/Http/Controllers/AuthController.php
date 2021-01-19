<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{

    private $apiToken;
    public function __construct(){
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
    }

    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] = $this->apiToken;
            $success['id'] = $user->id;
            $success['name'] = $user->nombre . " " . $user->apellido;
            return response()->json([
                'status' => 'success',
                'data' => $success
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'data' => 'Unauthorized Access'
            ]); 
        }
    }
}
