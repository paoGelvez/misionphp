<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\entrenadores;




class Validaciones extends Controller {
    public function validacionRegister($request){

        return $request->validate([
            'nombre'=> 'required|string',
            'apellido'=>'required|string',
            'edad'=> 'reuired|string'
        ]); 

    }

}



abstract class accionesEntrenadores extends Validaciones{
    public function index(){
        try{
            $entrenadores = entrenadores::all();
            if(!$entrenadores){
                return 'no hay entrenadores registrados';
            }else{
                return response()->json($entrenadores);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()

            ],404);
        }
    }
    public function show($id){
        try{
            $entrenadores = Deportes::find($id);
            if(!$entrenadores){
                return 'no existe el entrenador';
            }else{
                return response()->json($entrenadores);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()
            ],404);
        }
    }
    public function delete($id){
        try{
            $entrenadores = entrenadores::destroy($id);

        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }
    public function update(Request $request,$id){
        try{
            $request=$request->all();
            $entrenadores=entrenadores::find($id);
            if(!$entrenadores){
                return 'el entrenador no existe';
            }else{
                $entrenadores = entrenadores::find($id)->update($request);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }

}

class EntrenadoresController extends accionesEntrenadores
{

    public function registerSports(Request $request){

        try{
        
    
            $entrenadores = entrenadores::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'edad' => $request->edad,

                
            ]);
    
    
            
        }catch(\Exception $e){
            return response()->json([
                'message'=> $e ->getMessage()
            ]);
        }


    }
   
}


