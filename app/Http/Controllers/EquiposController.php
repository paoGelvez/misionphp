<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipos;


class Validaciones extends Controller {
    public function validacionRegister($request){

        return $request->validate([
            'nombre'=> 'required|string',
            'fundacion' => 'required|string',
            'promediado' => 'required|string',
            'id_usuarios'=> 'required|number',
            'id_deportes'=> 'required|number',
            'id_entrenador' => 'required|number',
        ]); 

    }

}


abstract class accionesEquipos extends Validaciones{
    public function index(){
        try{
            $equipos = Equipos::all();
            if(!$equipos){
                return 'no hay equipos registrados';
            }else{
                return response()->json($equipos);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()

            ],404);
        }
    }
    public function show($id){
        try{
            $equipos= Equipos::find($id);
            if(!$deportes){
                return 'no existe el equipo ';
            }else{
                return response()->json($equipos);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()
            ],404);
        }
    }
    public function delete($id){
        try{
            $equipos = Equipos::destroy($id);

        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }
    public function update(Request $request,$id){
        try{
            $request=$request->all();
            $equipos=Equipos::find($id);
            if(!$equipos){
                return 'el equipo no existe  ';
            }else{
                $equipos = Equipos::find($id)->update($request);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }

}



class EquiposController extends accionesEquipos
{
    public function registerEquipos(Request $request){

        try{
        
    
            $equipos = Equipos::create([
                'nombre' => $request->nombre,
                'fundacion' => $request->fundacion,
                'promediado' => $request->promediado,
                'id_usuarios'=> $request->id_usuarios,
                'id_deportes'=> $request->id_deportes,
                'id_entrenador'=> $request-> id_entrenador,
                
            ]);
    
    
            
        }catch(\Exception $e){
            return response()->json([
                'message'=> $e ->getMessage()
            ]);
        }


    }
}
