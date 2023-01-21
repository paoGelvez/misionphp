<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jugadores;





class Validaciones extends Controller {
    public function validacionRegister($request){

        return $request->validate([
            'nombre'=> 'required|string',
            'edad' => 'required|string',
            'calificacion' => 'required|string',
            'posicion'=> 'required|string',
            'id_equipos' => 'required|string'

        ]); 

    }

}


abstract class accionesJugadores extends Validaciones{
    public function index(){
        try{
            $jugadores = jugadores::all();
            if(!$jugadores){
                return 'no hay jugadores registrados';
            }else{
                return response()->json($jugadores);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()

            ],404);
        }
    }
    public function show($id){
        try{
            $jugadores=jugadores::find($id);
            if(!$deportes){
                return 'no existe el jugador';
            }else{
                return response()->json($jugadores);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()
            ],404);
        }
    }
    public function delete($id){
        try{
            $jugadores = jugadores::destroy($id);

        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }
    public function update(Request $request,$id){
        try{
            $request=$request->all();
            $jugadores=jugadores::find($id);
            if(!$jugadores){
                return 'el jugador no existe  ';
            }else{
                $jugadores = jugadores::find($id)->update($request);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }

}



class JugadoresController extends accionesJugadores
{
    public function registerEquipos(Request $request){

        try{
        
    
            $equipos = Equipos::create([
                'nombre' => $request->nombre,
                'edad' => $request->edad,
                'calificacion' => $request->calificacion,
                'posicion'=> $request->posicion,
                'id_equipos'=> $request->id_equipos,
                
            ]);
    
    
            
        }catch(\Exception $e){
            return response()->json([
                'message'=> $e ->getMessage()
            ]);
        }


    }
}
