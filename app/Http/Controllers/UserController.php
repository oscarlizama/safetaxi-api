<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
//use App\Models\Persona;

class UserController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return response()->json($usuarios);
    }

    public function show($id){
        if ($usuario = User::find($id)) {
            return response()->json($usuario);
        } else {
            return response()->json(['Error' => 'No encontrado'], 404);
        }
    }

    public function store(Request $request){
        //if($request->isJson()){
            $data = $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'sexo' => 'required',
                'email' => 'required',
                'password' => 'required',
                'fechaNacimiento' => 'required',
                'tipoUsuario' => 'required'
            ]);
            try{
                $usuario = new User();
                $usuario->email = $data['email'];
                $usuario->password = Hash::make($data['password']);
                $usuario->tipoUsuario = $data['tipoUsuario'];
                //$usuario->save();
                //$persona = new Persona();
                $usuario->nombre = $data['nombre'];
                $usuario->apellido = $data['apellido'];
                $usuario->sexo = $data['sexo'];
                $usuario->fechaNacimiento = $data['fechaNacimiento'];
                $usuario->save();
                return response()->json($usuario, 201);
            } catch(ModelNotFoundException $e){
                return response()->json(['error' => 'No se ha podido crear un usuario'], 404);
            }
        //}else{
            //return response()->json(['error' => 'No es un JSON válido'], 400, []);
        //}
    }

    public function update(Request $request, $id){
        if($usuario = User::find($id)){
            //return response()->json($request, 200);
            $data = $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                //'sexo' => 'required',
                'email' => 'required',
                'password' => 'required',
                'fechaNacimiento' => 'required'
            ]);
            //$usuario = Persona::where('user_id', $usuario->id)->first();
            $usuario->nombre = $data['nombre'];
            $usuario->apellido = $data['apellido'];
            //$persona->sexo = $data['sexo'];
            $usuario->fechaNacimiento = $data['fechaNacimiento'];
            $usuario->email = $data['email'];
            $usuario->password = Hash::make($data['password']);
            $usuario->save();
            //$persona->save();
            return response()->json($persona, 200);
        }else{
            return response()->json(['Error' => 'No encontrado'], 404);
        }
        return response()->json(['error' => 'Error'], 404);
    }

    public function destroy($id){
        try {
            $usuario = User::findOrFail($id);
            $usuario->delete();
            return response()->json($usuario, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No encontrado'], 404);
        }
    }
}
