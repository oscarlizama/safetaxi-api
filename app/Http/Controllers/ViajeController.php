<?php

namespace App\Http\Controllers;
use App\Models\Conductor;
use App\Models\Viaje;

use Illuminate\Http\Request;

class ViajeController extends Controller
{
    public function getSolicitudesViaje($estado){
        $viajes = Viaje::orderBy('fechaViaje')->where('estadoViaje', '=', $estado)->get();
        return response()->json($viajes);
    }

    public function getViaje($id){
        try{
            if($viaje = Viaje::find($id)){
                $viaje = Viaje::where('id', '=', $id)->with('user')->first();
                return response()->json($viaje, 201);
            }else{
                return response()->json(['Error' => 'No encontrado'], 404);
            }
        }catch(Exception $e){
            return response()->json(['Error' => $e], 404);
        }
    }

    public function solicitarViaje(Request $request){
        $data = $request->validate([
            'origenCoordenadas' => 'required',
            'destinoCoordenadas' => 'required',
            'origenTexto' => 'required',
            'destinoTexto' => 'required',
            'total' => 'required',
            'user_id' => 'required'
        ]);
        try{
            $viaje = new Viaje();
            $viaje->origenCoordenadas = $data['origenCoordenadas'];
            $viaje->destinoCoordenadas = $data['destinoCoordenadas'];
            $viaje->origenTexto = $data['origenTexto'];
            $viaje->destinoTexto = $data['destinoTexto'];
            $viaje->user_id = $data['user_id'];
            $viaje->total = $data['total'];
            $viaje->save();
            return response()->json($viaje, 201);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'No se ha podido solicitar un viaje'], 404);
        }
    }

    public function asignarViaje(Request $request, $id){
        try{
            if($viaje = Viaje::find($id)){
                /*$data = $request->validate([
                    'conductor_id',
                ]);*/
                $data = $request;
                if($conductor = Conductor::find($data['conductor_id'])){
                    $viaje->estadoViaje = 'e';
                    $viaje->conductor_id = $conductor->id;
                    $viaje->save();
                    $conductor->enServicio = 1;
                    $conductor->save();
                    return response()->json($viaje, 201);
                }else{
                    return response()->json(['Error' => 'Conductor no encontrado'], 404);    
                }
            }else{
                return response()->json(['Error' => 'Viaje no encontrado'], 404);
            }
        }catch(Exception $ex){
            return response()->json(['Error' => $e], 404);
        }
    }

    public function terminarViaje($id){
        try{
            if($viaje = Viaje::find($id)){
                $viaje->estadoViaje = 'f';
                $viaje->save();
                $conductor = Conductor::find($viaje->conductor_id);
                $conductor->enServicio = 0;
                $conductor->save();
                return response()->json($viaje, 201);
            }else{
                return response()->json(['Error' => 'Viaje no encontrado'], 404);
            }
        }catch(Exception $ex){
            return response()->json(['Error' => $e], 404);
        }
    }

    public function rechazarViaje($id){
        try{
            if($viaje = Viaje::find($id)){
                $viaje->estadoViaje = 'r';
                $viaje->save();
                return response()->json($viaje, 201);
            }else{
                return response()->json(['Error' => 'Viaje no encontrado'], 404);
            }
        }catch(Exception $ex){
            return response()->json(['Error' => $e], 404);
        }
    }

}
