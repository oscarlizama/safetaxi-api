<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Horario;

class HorarioController extends Controller
{

    public function index($idConductor){
        $horarios = Horario::where('conductor_id', $idConductor)->get();
        return response()->json($horarios);
    }

    public function show($id){
        if ($horario = Horario::find($id)) {
            return response()->json($horario);
        } else {
            return response()->json(['Error' => 'Horario no encontrado'], 404);
        }
    }

    public function store(Request $request){
        if ($request->has('disponible')){
            $data = $request->validate([
                'dia' =>'required',
                'horaInicio' =>'required',
                'horaFin' =>'required',
                'disponible' =>'required',
                'conductor_id' =>'required'
            ]);
        }else{
            $data = $request->validate([
                'dia' =>'required',
                'horaInicio' =>'required',
                'horaFin' =>'required',
                'conductor_id' =>'required'
            ]);
        }
        try{
            $horario = Horario::create($data);
            return response()->json($horario, 201);
        }catch(ModelNotFoundException $e){
            return response()->json(['error' => 'No se agregó el horario'], 404);
        }
    }

    public function update(Request $request, $id){
        if($horario = Horario::find($id)){
            $data = $request->validate([
                'dia' =>'required',
                'horaInicio' =>'required',
                'horaFin' =>'required',
                'disponible' =>'required',
            ]);

            $horario->dia = $data['dia'];
            $horario->horaInicio = $data['horaInicio'];
            $horario->horaFin = $data['horaFin'];
            $horario->disponible = $data['disponible'];
            $horario->save();
            
            return response()->json($horario, 200);

        }else{
            return response()->json(['Error' => 'No encontrado'], 404);
        }
    }

    public function destroy($id){
        try {
            $horario = Horario::findOrFail($id);
            $horario->delete();
            return response()->json($horario, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No encontrado'], 404);
        }
    }

}
