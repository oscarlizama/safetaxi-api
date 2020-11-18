<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vehiculo;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

class VehiculoController extends Controller
{
    public function index($estado){
        $vehiculos = Vehiculo::with('conductor')->get()->where('enServicio', "=", $estado);
        return response()->json($vehiculos);
    }

    public function show($id){
        if ($vehiculo = Vehiculo::find($id)) {
            $vehiculo = Vehiculo::with('conductor')->where('id', '=', $id)->first();
            return response()->json($vehiculo, 201);
        } else {
            return response()->json(['Error' => 'No encontrado'], 404);
        }
    }

    public function store(Request $request){
        $data = $request->validate([
            'matricula' => 'required|unique:vehiculos',
            'capacidad' => 'required',
            'numeroChasis' => 'required|unique:vehiculos',
            'anio' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'tipoVehiculo' => 'required',
            'clase' => 'required',
            'color' => 'required',
            'numeroTarjetaCirculacion' => 'required|unique:vehiculos',
            'conductor_id' => 'required|unique:vehiculos'
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
            $vehiculo->tipoVehiculo = $data['tipoVehiculo'];
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

    public function servicio($id){
        try {
            $vehiculo = Vehiculo::findOrFail($id);
            $vehiculo->enServicio = !($vehiculo->enServicio);
            $vehiculo->save();
            return response()->json($vehiculo, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No encontrado'], 404);
        }
    }

    /*public function uploadFile(Request $request){
        $id = $request['id'];
        if($vehiculo = Vehiculo::find($id)){
            $archivo = $request->file('archivo');
            $filename = $archivo->getClientOriginalName();
            $archivo->move("/home/archivos/tarjetas/", $archivo->getClientOriginalName());
            $path = "/home/archivos/tarjetas/" . $id . $filename;
            $vehiculo->archivoTarjetaCirculacion = $path;
            $vehiculo->save();
            return response()->json($filename, 200);
        }else{
            return response()->json(['error' => 'No encontrado'], 404);
        }
    }*/

}
