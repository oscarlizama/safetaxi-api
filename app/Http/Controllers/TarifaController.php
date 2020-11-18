<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarifa;

class TarifaController extends Controller
{
    public function index(){
        $tarifas = Tarifa::all();
        return response()->json($tarifas);
    }

    public function show($id){
        if($tarifa = Tarifa::find($id)){
            return response()->json($tarifa, 201);
        }else{
            return response()->json(['Error' => 'No encontrado'], 404);
        }
    }

    public function store(Request $request){
        $data = $request->validate([
            'criterio' => 'required',
            'valor' => 'required',
            'identificar' => 'required'
        ]);
        try{
            $tarifa = Tarifa::create($data);
            return response()->json($data, 201);
        }catch(Exception $ex){
            return response()->json(['error' => 'No se ha podido crear un vehiculo'], 404);
        }
        return response()->json($data, 201);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'criterio' => 'required',
            'valor' => 'required',
            'identificar' => 'required',
            'fechaInicioTarifa' => 'nullable|date',
            'fechaFinTarifa' => 'nullable|date',
            'horaInicioTarifa' => 'nullable',
            'horaFinTarifa' => 'nullable'
        ]);
        //$data = $request;
        try{
            if($tarifa = Tarifa::find($id)){
                $tarifa->criterio = $data['criterio'];
                $tarifa->valor = $data['valor'];
                $tarifa->identificar = $data['identificar'];
                $tarifa->fechaInicioTarifa = $data['fechaInicioTarifa'];
                $tarifa->fechaFinTarifa = $data['fechaFinTarifa'];
                $tarifa->horaInicioTarifa = $data['horaInicioTarifa'];
                $tarifa->horaFinTarifa = $data['horaFinTarifa'];
                $tarifa->save();
                return response()->json($tarifa, 201);
            }else{
                return response()->json(['Error' => 'No encontrado'], 404);
            }
        }catch(Exception $ex){
            return response()->json(['Error' => $e], 404);
        }
    }

    public function destroy($id){
        try {
            $tarifa = Tarifa::findOrFail($id);
            $tarifa->delete();            
            return response()->json($tarifa, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No encontrado'], 404);
        }
    }

}
