<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class Validaciones extends Controller {
    public function validacionRegister($request){

        return $request->validate([
            'nombre'=> 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'admin_code' => 'string'
        ]); 

    }

}
abstract class accionesUsuario extends Validaciones{
    public function login(Request $request){
        $credentials = $request->only(['email','password']);

        if(! $token=auth()->attempt($credentials)){
            return response()->json(['error'=>'Unathorized'],401);
        }

        return response()->json([
            'acces_token'=> $token,
            'token_type'=> 'Bearer',
            'expires_in' => 3600
        ]);
    }

    public function me(){
        $user = User::where('id', Auth::user()->id)->with(['roles', 'roles.permissions'])->first();
        return response()->json($user);
    }

    public function logout(){
        Auth::logout();
        return response()->json(['message'=>'cerrar sesion con exito']);
    }

}

class AuthController extends accionesUsuario
{

    public function register(Request $request){

        try{
    
            $user = User::create([
                'nombre' => $request->nombre,
                'email'=> $request->email,
                'password'=>bcrypt($request->password)
            ]);
    
            if($request->admin_code && $request->admin_code =='programaresGod'){
                $user->assignRole('admin');
            }else{
                $user->assignRole('Manager');
            }
    
            
        }catch(\Exception $e){
            return response()->json([
                'message'=> $e ->getMessage()
            ]);
        }


    }
   
}



