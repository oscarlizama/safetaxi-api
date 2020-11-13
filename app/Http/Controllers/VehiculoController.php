<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehiculo;

class VehiculoController extends Controller
{
    public function index(){
        $vehiculos = Vehiculo::with('conductor')->get();
        return response()->json($vehiculos);
    }

    public function show($id){
        if ($vehiculo = Vehiculo::find($id)) {
            $vehiculo = Vehiculo::with('conductor')->where('id', '=', $id)->first();
            return response()->json($vehiculo, 404);
        } else {
            return response()->json(['Error' => 'No encontrado'], 404);
        }
    }

    public function store(Request $request){
        $data = $request->validate([
            'matricula' => 'required',
            'capacidad' => 'required',
            'numeroChasis' => 'required',
            'anio' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'tipoVehiculo' => 'required',
            'clase' => 'required',
            'color' => 'required',
            'numeroTarjetaCirculacion' => 'required',
            'conductor_id' => 'required'
        ]);
        try{
            $vehiculo = new Vehiculo();

            $vehiculo->matricula = $data['matricula'];
            $vehiculo->capacidad = $data['capacidad'];
            $vehiculo->numeroChasis = $data['numeroChasis'];
            $vehiculo->anio = $data['anio'];
            $vehiculo->marca = $data['marca'];
            $vehiculo->modelo = $data['modelo'];
            $vehiculo->clase = $data['clase'];
            $vehiculo->color = $data['color'];
            $vehiculo->tipoVehiculo = $data['tipoVehiculo'];
            $vehiculo->numeroTarjetaCirculacion = $data['numeroTarjetaCirculacion'];
            $vehiculo->conductor_id = $data['conductor_id'];
            $vehiculo->save();

            $vehiculo = Vehiculo::with('conductor')->where('id', '=', $vehiculo->id)->first();
            return response()->json($vehiculo, 201);
        } catch(ModelNotFoundException $e){
            return response()->json(['error' => 'No se ha podido crear un vehiculo'], 404);
        }
    }

    public function update(Request $request, $id){
        if($vehiculo = Vehiculo::find($id)){
            $data = $request->validate([
                'matricula' => 'required',
                'capacidad' => 'required',
                'numeroChasis' => 'required',
                'anio' => 'required',
                'marca' => 'required',
                'modelo' => 'required',
                'tipoVehiculo' => 'required',
                'clase' => 'required',
                'color' => 'required',
                'numeroTarjetaCirculacion' => 'required',
                'conductor_id' => 'required'
            ]);
            $vehiculo->matricula = $data['matricula'];
            $vehiculo->capacidad = $data['capacidad'];
            $vehiculo->numeroChasis = $data['numeroChasis'];
            $vehiculo->anio = $data['anio'];
            $vehiculo->marca = $data['marca'];
            $vehiculo->modelo = $data['modelo'];
            $vehiculo->clase = $data['clase'];
            $vehiculo->color = $data['color'];
            $vehiculo->color = $data['tipoVehiculo'];
            $vehiculo->numeroTarjetaCirculacion = $data['numeroTarjetaCirculacion'];
            $vehiculo->conductor_id = $data['conductor_id'];
            $vehiculo->save();

            $vehiculo = Vehiculo::with('conductor')->where('id', '=', $id)->first();
            return response()->json($vehiculo, 200);
        }else{
            return response()->json(['Error' => 'No encontrado'], 404);
        }
    }

    public function destroy($id){
        try {
            $vehiculo = Vehiculo::findOrFail($id);
            $vehiculo->delete();            
            return response()->json($vehiculo, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No encontrado'], 404);
        }
    }

}
