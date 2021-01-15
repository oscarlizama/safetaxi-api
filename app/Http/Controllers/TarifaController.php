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
            'identificar' => 'required',
            'fechaInicioTarifa' => 'nullable|date',
            'fechaFinTarifa' => 'nullable|date',
            'horaInicioTarifa' => 'nullable',
            'horaFinTarifa' => 'nullable'
        ]);
        try{
            $tarifa = new Tarifa();
            $tarifa->criterio = $data['criterio'];
            $tarifa->valor = round($data['valor'], 4);
            $tarifa->identificar = $data['identificar'];
            $tarifa->fechaInicioTarifa = $data['fechaInicioTarifa'];
            $tarifa->fechaFinTarifa = $data['fechaFinTarifa'];
            $tarifa->horaInicioTarifa = $data['horaInicioTarifa'];
            $tarifa->horaFinTarifa = $data['horaFinTarifa'];
            $tarifa->save();
            return response()->json($data, 201);
        }catch(Exception $ex){
            return response()->json(['error' => 'No se ha podido crear una tarifa'], 404);
        }
        return response()->json($data, 201);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'criterio' => 'required',
            'valor' => 'required',
            'identificar' => 'required',
            'fechaInicioTarifa' => 'nullable',
            'fechaFinTarifa' => 'nullable',
            'horaInicioTarifa' => 'nullable',
            'horaFinTarifa' => 'nullable',
            'sinCaducidadFecha' => 'required',
            'sinCaducidadHora' => 'required'
        ]);
        //$data = $request;
        try{
            if($tarifa = Tarifa::find($id)){
                $tarifa->criterio = $data['criterio'];
                $tarifa->valor = round($data['valor'], 4);
                $tarifa->identificar = $data['identificar'];
                if(!$data['sinCaducidadFecha']){
                    if($data['fechaInicioTarifa'] != "null")
                        $tarifa->fechaInicioTarifa = $data['fechaInicioTarifa'];
                    if($data['fechaFinTarifa'] != "null")
                        $tarifa->fechaFinTarifa = $data['fechaFinTarifa'];
                }else{
                    $tarifa->fechaInicioTarifa = NULL;
                    $tarifa->fechaFinTarifa = NULL;
                }
                if(!$data['sinCaducidadHora']){
                    if($data['horaInicioTarifa'] != "null")
                        $tarifa->horaInicioTarifa = $data['horaInicioTarifa'];
                    if($data['horaFinTarifa'] != "null")
                        $tarifa->horaFinTarifa = $data['horaFinTarifa'];
                }else{
                    $tarifa->horaInicioTarifa = NULL;
                    $tarifa->horaFinTarifa = NULL;
                }
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

    public function tarifasViaje(Request $request){
        $data = $request;
        try{
            //$tarifas = Tarifa::all();
            $tarifasFechaHora = Tarifa::where(function ($query) use ($data){
                    $query->where('fechaInicioTarifa', '<=', $data['fechaViaje'])
                    ->where('fechaFinTarifa', '>=', $data['fechaViaje']);
                })
                ->orWhere(function ($query) use ($data){
                    $query->where('horaInicioTarifa', '<=', $data['horaViaje'])
                        ->where('horaFinTarifa', '>=', $data['horaViaje']);
                })
                ->get();
            $tarifasNormales = Tarifa::whereNull('fechaInicioTarifa')
                ->whereNull('fechaFinTarifa')
                ->whereNull('horaInicioTarifa')
                ->whereNull('horaFinTarifa')
                ->get();
            return response()->json(['normales' => $tarifasNormales, 'condicionadas' => $tarifasFechaHora], 201);
        }catch(Exception $ex){
            return response()->json(['Error' => "No encontrado"], 404);
        }
    }

}
