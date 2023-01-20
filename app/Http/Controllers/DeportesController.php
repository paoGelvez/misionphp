<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deportes;


class Validaciones extends Controller {
    public function validacionRegister($request){

        return $request->validate([
            'sport name'=> 'required|string',
        ]); 

    }

}



abstract class accionesDeportes extends Validaciones{
    public function index(){
        try{
            $deportes = Deportes::all();
            if(!$deportes){
                return 'no hay deportes registrados';
            }else{
                return response()->json($deportes);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()

            ],404);
        }
    }
    public function show($id){
        try{
            $deportes = Deportes::find($id);
            if(!$deportes){
                return 'no existe el deporte';
            }else{
                return response()->json($deportes);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage()
            ],404);
        }
    }
    public function delete($id){
        try{
            $deportes = Deportes::destroy($id);

        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }
    public function update(Request $request,$id){
        try{
            $request=$request->all();
            $deportes=Deportes::find($id);
            if(!$deportes){
                return 'el deportes no existe  ';
            }else{
                $deportes = Deportes::find($id)->update($request);
            }
        }catch(\Exception $e){
            return response()->json([
                'error'=>$e->getMessage()
            ],404);
        }
    }

}

class DeportesController extends accionesDeportes
{

    public function registerSports(Request $request){

        try{
        
    
            $deportes = Deportes::create([
                'sportName' => $request->sportName,
                
            ]);
    
    
            
        }catch(\Exception $e){
            return response()->json([
                'message'=> $e ->getMessage()
            ]);
        }


    }
   
}

