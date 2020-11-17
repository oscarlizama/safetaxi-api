<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Conductor;
//use App\Models\Persona;
use App\Models\User;

class ConductorController extends Controller
{
    public function index(){
        $conductores = Conductor::with('user')->get();
        return response()->json($conductores);
    }

    public function show($id){
        if ($conductor = Conductor::find($id)) {
            //$persona = Persona::where('conductor_id', $conductor->id)->first();
            $conductor = Conductor::with('user')->where('id', '=', $id)->first();
            return response()->json($conductor, 404);
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
                'fechaContratacion' => 'required',
                'licenciaConducir' => 'required',
                'dui' => 'required'
            ]);
            try{
                $conductor = new Conductor();
                $usuario = new User();
                //$persona = new Persona();
                
                $usuario->email = $data['email'];
                $usuario->password = Hash::make($data['password']);
                $usuario->tipoUsuario = 'C';
                //$usuario->save();
                
                $usuario->nombre = $data['nombre'];
                $usuario->apellido = $data['apellido'];
                $usuario->sexo = $data['sexo'];
                $usuario->fechaNacimiento = $data['fechaNacimiento'];
                /*$persona->user_id = $usuario->id;
                $persona->save();*/
                $usuario->save();

                $conductor->fechaContratacion = $data['fechaContratacion'];
                $conductor->licenciaConducir = $data['licenciaConducir'];
                $conductor->dui = $data['dui'];
                $conductor->user_id = $usuario->id;
                $conductor->save();

                $conductor = Conductor::with('user')->where('id', '=', $conductor->id)->first();
                return response()->json($conductor, 201);
            } catch(ModelNotFoundException $e){
                return response()->json(['error' => 'No se ha podido crear un conductor'], 404);
            }
        //}else{
            //return response()->json(['error' => 'No es un JSON válido'], 400, []);
        //}
    }

    public function update(Request $request, $id){
        if($conductor = Conductor::find($id)){
            //return response()->json($request, 200);
            $data = $request->validate([
                'nombre' => 'required',
                'apellido' => 'required',
                'sexo' => 'required',
                'email' => 'required',
                'password' => 'required',
                'fechaNacimiento' => 'required',
                'fechaContratacion' => 'required',
                'licenciaConducir' => 'required',
                'dui' => 'required'
            ]);
            //$persona = Persona::where('id', $conductor->persona_id)->first();
            $usuario = User::where('id', $conductor->user_id)->first();
            
            $usuario->nombre = $data['nombre'];
            $usuario->apellido = $data['apellido'];
            $usuario->sexo = $data['sexo'];
            $usuario->fechaNacimiento = $data['fechaNacimiento'];

            $usuario->email = $data['email'];
            $usuario->password = Hash::make($data['password']);

            $conductor->fechaContratacion = $data['fechaContratacion'];
            $conductor->licenciaConducir = $data['licenciaConducir'];
            $conductor->dui = $data['dui'];
            
            $usuario->save();
            //$persona->save();
            $conductor->save();
            
            return response()->json($conductor, 200);
        }else{
            return response()->json(['Error' => 'No encontrado'], 404);
        }
        return response()->json(['error' => 'Error'], 404);
    }

    public function destroy($id){
        try {
            $conductor = Conductor::findOrFail($id);
            $usuario = User::where('id', $conductor->user_id)->first();
            $conductor->delete();            
            $usuario->delete();
            return response()->json($conductor, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No encontrado'], 404);
        }
    }

    public function servicio($id){
        try {
            $conductor = Conductor::findOrFail($id);
            $conductor->estadoContratado = !($conductor->estadoContratado);
            $conductor->save();
            return response()->json($conductor, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No encontrado'], 404);
        }
    }

}
